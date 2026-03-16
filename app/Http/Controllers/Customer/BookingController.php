<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Trip;
use App\Models\SeatLock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        // Đảm bảo khách hàng chỉ xem được vé của mình
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Không có quyền truy cập');
        }

        $booking->load(['trip.route', 'tickets.seat', 'pickupPoint']);
        return view('customer.bookings.show', compact('booking'));
    }

    // Xử lý lưu đơn đặt vé mới
    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'pickup_point_id' => 'required|exists:pickup_points,id',
            'seat_ids' => 'required|array|min:1',
            'seat_ids.*' => 'exists:seats,id',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
        ]);

        $trip = Trip::findOrFail($request->trip_id);
        $totalAmount = $trip->price * count($request->seat_ids);

        DB::beginTransaction();
        try {
            // 1. Tạo Booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'trip_id' => $trip->id,
                'pickup_point_id' => $request->pickup_point_id,
                'contact_name' => $request->contact_name,
                'contact_phone' => $request->contact_phone,
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            // 2. Khóa ghế (SeatLock)
            foreach ($request->seat_ids as $seatId) {
                // Kiểm tra lại lần cuối xem ghế có bị ai nẫng tay trên không
                $isLocked = SeatLock::where('trip_id', $trip->id)->where('seat_id', $seatId)->exists();
                if ($isLocked) {
                    throw new \Exception('Một số ghế bạn chọn đã có người khác đặt.');
                }

                SeatLock::create([
                    'trip_id' => $trip->id,
                    'seat_id' => $seatId,
                    'user_id' => Auth::id(),
                    'booking_id' => $booking->id,
                    'locked_until' => now()->addMinutes(15), // Khóa tạm 15 phút chờ thanh toán
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