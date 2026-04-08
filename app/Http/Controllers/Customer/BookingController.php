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
            'pickup_point_id'  => 'required|exists:pickup_points,id',
            'dropoff_point_id' => 'nullable|exists:pickup_points,id',
            'coupon_code'      => 'nullable|string|max:50',
            'seat_ids'         => 'required|array|min:1',
            'seat_ids.*'       => 'exists:seats,id',
            'contact_name'     => 'required|string|max:255',
            'contact_phone'    => 'required|string|max:20',
        ]);

        $trip        = Trip::findOrFail($request->trip_id);
        $baseAmount  = $trip->price * count($request->seat_ids);
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

            foreach ($request->seat_ids as $seatId) {
                $isLocked = SeatLock::where('trip_id', $trip->id)->where('seat_id', $seatId)->exists();
                if ($isLocked) {
                    throw new \Exception('Một số ghế bạn chọn đã có người khác đặt.');
                }

                SeatLock::create([
                    'trip_id'      => $trip->id,
                    'seat_id'      => $seatId,
                    'user_id'      => Auth::id(),
                    'booking_id'   => $booking->id,
                    'locked_until' => now()->addMinutes(15),
                ]);

                Ticket::create([
                    'booking_id' => $booking->id,
                    'trip_id'    => $trip->id,
                    'seat_id'    => $seatId,
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
}