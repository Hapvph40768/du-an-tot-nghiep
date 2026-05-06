<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Trip;
use App\Models\Ticket;
use App\Models\SeatLock;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Danh sách vé đã đặt của khách hàng
    public function index()
    {
        $bookings = Booking::with(['trip.route.startLocation', 'trip.route.endLocation'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.bookings.index', compact('bookings'));
    }

    // Hiển thị chi tiết 1 đơn đặt vé
    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Không có quyền truy cập');
        }

        $booking->load([
            'trip.route',
            'tickets.seat',
            'tickets.trip',
            'pickupPoint',
            'dropoffPoint',
            'promotion',
            'trip.vehicle.parkingSlot.parking.slots'
        ]);
        return view('customer.bookings.show', compact('booking'));
    }

    // AJAX: Kiểm tra mã giảm giá
    public function checkCoupon(Request $request)
    {
        $code       = trim($request->input('code', ''));
        $baseAmount = (float) $request->input('base_amount', 0);

        if (empty($code)) {
            return response()->json(['valid' => false, 'message' => 'Vui lòng nhập mã giảm giá.']);
        }

        $promo = Promotion::where('code', $code)->first();

        if (!$promo) {
            return response()->json(['valid' => false, 'message' => 'Mã giảm giá không tồn tại.']);
        }

        $now = Carbon::now();
        if ($promo->start_date && $now->lt($promo->start_date)) {
            return response()->json(['valid' => false, 'message' => 'Mã giảm giá chưa đến thời gian sử dụng.']);
        }
        if ($promo->end_date && $now->gt($promo->end_date)) {
            return response()->json(['valid' => false, 'message' => 'Mã giảm giá đã hết hạn.']);
        }
        if ($promo->max_uses !== null && $promo->current_uses >= $promo->max_uses) {
            return response()->json(['valid' => false, 'message' => 'Mã giảm giá đã hết lượt sử dụng.']);
        }

        if ($promo->type === 'percent') {
            $discount = round(($baseAmount * $promo->value) / 100);
        } else {
            $discount = min((float) $promo->value, $baseAmount);
        }

        $finalAmount = max(0, $baseAmount - $discount);

        return response()->json([
            'valid'        => true,
            'message'      => 'Mã hợp lệ! ' . ($promo->type === 'percent' ? 'Giảm ' . $promo->value . '%' : 'Giảm ' . number_format($promo->value, 0, ',', '.') . 'đ'),
            'discount'     => $discount,
            'final_amount' => $finalAmount,
            'promo_id'     => $promo->id,
            'promo_label'  => $promo->type === 'percent'
                                ? "Giảm {$promo->value}%"
                                : 'Giảm ' . number_format($promo->value, 0, ',', '.') . 'đ',
        ]);
    }

    // Xử lý lưu đơn đặt vé mới
    public function store(Request $request)
    {
        $request->validate([
            'trip_id'          => 'required|exists:trips,id',
            'pickup_point_id'  => ['required', \Illuminate\Validation\Rule::exists('trip_pickup_points', 'pickup_point_id')->where('trip_id', $request->trip_id)],
            'dropoff_point_id' => ['nullable', \Illuminate\Validation\Rule::exists('trip_pickup_points', 'pickup_point_id')->where('trip_id', $request->trip_id)],
            'coupon_code'      => 'nullable|string|max:50',
            'ticket_quantity'  => 'required|integer|min:1|max:4',
            'contact_name'     => 'required|string|max:255',
            'contact_phone'    => 'required|string|max:20',
        ]);

        $userBookedTickets = Ticket::whereHas('booking', function ($q) {
            $q->where('user_id', Auth::id());
        })
        ->where('trip_id', $request->trip_id)
        ->whereIn('status', ['pending', 'confirmed'])
        ->count();

        if ($userBookedTickets + $request->ticket_quantity > 4) {
            return back()->with('error', 'Mỗi tài khoản được mua tối đa 4 vé trên chuyến này. Bạn đã có ' . $userBookedTickets . ' vé hợp lệ hoặc đang chờ thanh toán.');
        }

        $trip        = Trip::findOrFail($request->trip_id);
        
        $totalSeats = $trip->vehicle->seats()->count();
        $bookedSeats = Ticket::where('trip_id', $trip->id)->whereIn('status', ['pending', 'confirmed'])->count();
        if ($bookedSeats + $request->ticket_quantity > $totalSeats) {
            return back()->with('error', 'Chuyến xe không đủ số lượng vé trống yêu cầu.');
        }

        $baseAmount  = $trip->price * $request->ticket_quantity;
        $discount    = 0;
        $promotionId = null;

        if ($request->filled('coupon_code')) {
            $promo = Promotion::where('code', trim($request->coupon_code))->first();
            if ($promo) {
                $now   = Carbon::now();
                $valid = true;
                if ($promo->start_date && $now->lt($promo->start_date)) $valid = false;
                if ($promo->end_date   && $now->gt($promo->end_date))   $valid = false;
                if ($promo->max_uses !== null && $promo->current_uses >= $promo->max_uses) $valid = false;

                if ($valid) {
                    $discount    = $promo->type === 'percent'
                        ? round(($baseAmount * $promo->value) / 100)
                        : min((float) $promo->value, $baseAmount);
                    $promotionId = $promo->id;
                }
            }
        }

        $totalAmount = max(0, $baseAmount - $discount);

        DB::beginTransaction();
        try {
            $booking = Booking::create([
                'user_id'          => Auth::id(),
                'trip_id'          => $trip->id,
                'pickup_point_id'  => $request->pickup_point_id,
                'dropoff_point_id' => $request->dropoff_point_id ?: null,
                'promotion_id'     => $promotionId,
                'discount_amount'  => $discount,
                'contact_name'     => $request->contact_name,
                'contact_phone'    => $request->contact_phone,
                'total_amount'     => $totalAmount,
                'status'           => 'pending',
            ]);

            if ($promotionId) {
                Promotion::where('id', $promotionId)->increment('current_uses');
            }

            for ($i = 0; $i < $request->ticket_quantity; $i++) {
                Ticket::create([
                    'booking_id' => $booking->id,
                    'trip_id'    => $trip->id,
                    'seat_id'    => null,
                    'status'     => 'pending',
                ]);
            }

            DB::commit();
            return redirect()->route('customer.payment.checkout', $booking->id)
                             ->with('success', 'Giữ chỗ thành công. Vui lòng thanh toán trong 15 phút.');
        } catch (\Exception $e) {

    DB::rollBack();

    return back()->with('error', $e->getMessage());
}
}
    public function cancel(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) abort(403);
        if ($booking->status !== 'paid') {
            return back()->with('error', 'Chỉ có thể hủy vé đã thanh toán.');
        }

        $departure = Carbon::parse($booking->trip->trip_date . ' ' . $booking->trip->departure_time);
        if (now()->diffInHours($departure, false) < 4) {
            return back()->with('error', 'Chỉ được phép hủy vé trước giờ khởi hành tối thiểu 4 tiếng.');
        }

        $minutesSinceBooking = $booking->created_at->diffInMinutes(now());
        $penaltyFee = 0;
        // Trừ 10% nếu hủy sau 30 phút
        if ($minutesSinceBooking > 30) {
            $penaltyFee = $booking->total_amount * 0.10;
        }

        $refundAmount = max(0, $booking->total_amount - $penaltyFee);

        DB::beginTransaction();
        try {
            $booking->update([
                'status' => 'cancelled',
                'refund_amount' => $refundAmount,
                'penalty_fee' => $penaltyFee,
            ]);

            // Release seats
            Ticket::where('booking_id', $booking->id)->update(['status' => 'cancelled']);
            SeatLock::where('booking_id', $booking->id)->delete();

            DB::commit();
            return back()->with('success', "Đã yêu cầu hủy vé thành công. Phí hủy: " . number_format($penaltyFee) . "đ. Số tiền chờ hoàn lại: " . number_format($refundAmount) . "đ.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi khi hủy vé.');
        }
    }

    public function changeDate(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) abort(403);
        if ($booking->status !== 'paid') {
            return back()->with('error', 'Chỉ có thể đổi vé đã thanh toán.');
        }

        $departure = Carbon::parse($booking->trip->trip_date . ' ' . $booking->trip->departure_time);
        if (now()->diffInHours($departure, false) < 2) {
            return back()->with('error', 'Chỉ được phép đổi vé trước giờ khởi hành tối thiểu 2 tiếng.');
        }

        // Tiền vé cũ
        $oldAmount = $booking->total_amount;
        $penaltyFee = $oldAmount * 0.10; // Phụ phí đổi vé 10%
        $creditAmount = max(0, $oldAmount - $penaltyFee);

        $availableTrips = Trip::with('vehicle')
            ->where('route_id', $booking->trip->route_id)
            ->where(DB::raw("CONCAT(trip_date, ' ', departure_time)"), '>', now()->addHours(2))
            ->where('id', '!=', $booking->trip_id)
            ->where('status', 'active')
            ->orderBy('trip_date')
            ->orderBy('departure_time')
            ->get();

        return view('customer.bookings.change-date', compact('booking', 'penaltyFee', 'creditAmount', 'availableTrips'));
    }

    public function processChangeDate(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) abort(403);
        if ($booking->status !== 'paid') {
            return back()->with('error', 'Chỉ có thể đổi vé đã thanh toán.');
        }

        $departure = Carbon::parse($booking->trip->trip_date . ' ' . $booking->trip->departure_time);
        if (now()->diffInHours($departure, false) < 2) {
            return back()->with('error', 'Chỉ được phép đổi vé trước giờ khởi hành tối thiểu 2 tiếng.');
        }

        $request->validate([
            'new_trip_id' => 'required|exists:trips,id',
            'ticket_quantity' => 'required|integer|min:1|max:4',
        ]);

        $userBookedTickets = Ticket::whereHas('booking', function ($q) {
            $q->where('user_id', Auth::id());
        })
        ->where('trip_id', $request->new_trip_id)
        ->whereIn('status', ['pending', 'confirmed'])
        ->count();

        if ($userBookedTickets + $request->ticket_quantity > 4) {
            return back()->with('error', 'Mỗi tài khoản được mua tối đa 4 vé trên chuyến này. Lần đổi này làm tổng số vé vượt quá 4.');
        }

        $newTrip = Trip::findOrFail($request->new_trip_id);
        
        // Cùng tuyến?
        if ($newTrip->route_id !== $booking->trip->route_id) {
            return back()->with('error', 'Chuyến xe thay thế phải cùng tuyến đường.');
        }
        
        $totalSeats = $newTrip->vehicle->seats()->count();
        $bookedSeats = Ticket::where('trip_id', $newTrip->id)->whereIn('status', ['pending', 'confirmed'])->count();
        if ($bookedSeats + $request->ticket_quantity > $totalSeats) {
            return back()->with('error', 'Chuyến xe không đủ số lượng vé trống yêu cầu.');
        }

        $baseAmount = $newTrip->price * $request->ticket_quantity;
        
        // Phụ phí 10% của vé cũ
        $penaltyFee = $booking->total_amount * 0.10;
        $creditAmount = max(0, $booking->total_amount - $penaltyFee);
        
        // Số tiền bù = Giá vé mới - Tiền còn lại từ vé cũ
        $extraPay = max(0, $baseAmount - $creditAmount);

        DB::beginTransaction();
        try {
            // Hủy vé cũ
            $booking->update([
                'status' => 'cancelled',
                'refund_amount' => 0, // Tiền này được dùng để cấn trừ vé mới
                'penalty_fee' => $penaltyFee,
            ]);
            Ticket::where('booking_id', $booking->id)->update(['status' => 'cancelled']);
            SeatLock::where('booking_id', $booking->id)->delete();

            // Tạo đặt vé mới
            $newBooking = Booking::create([
                'user_id' => Auth::id(),
                'trip_id' => $newTrip->id,
                'pickup_point_id' => $booking->pickup_point_id,
                'dropoff_point_id' => $booking->dropoff_point_id,
                'contact_name' => $booking->contact_name,
                'contact_phone' => $booking->contact_phone,
                'total_amount' => $extraPay,
                'status' => $extraPay > 0 ? 'pending' : 'paid', // Nếu ko phải bù tiền, coi như đã paid
            ]);

            for ($i = 0; $i < $request->ticket_quantity; $i++) {
                Ticket::create([
                    'booking_id' => $newBooking->id,
                    'trip_id' => $newTrip->id,
                    'seat_id' => null,
                    'status' => $extraPay > 0 ? 'pending' : 'confirmed',
                ]);
            }

            DB::commit();
            if ($extraPay > 0) {
                return redirect()->route('customer.payment.checkout', $newBooking->id)
                             ->with('success', 'Tạo yêu cầu đổi vé thành công. Vui lòng thanh toán khoản tiền bù để hoàn tất.');
            } else {
                return redirect()->route('customer.bookings.show', $newBooking->id)
                             ->with('success', 'Đổi vé thành công. Bạn không cần thanh toán thêm.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}