<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // Hiển thị trang chọn phương thức thanh toán
    public function checkout(Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || $booking->status !== 'pending') {
            return redirect()->route('customer.bookings.index')->with('error', 'Đơn hàng không hợp lệ.');
        }

        return view('customer.payment.checkout', compact('booking'));
    }

    // Xử lý thanh toán (Giả lập)
    public function process(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 1. Tạo record thanh toán
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'payment_method' => $request->payment_method,
                'amount' => $booking->total_amount,
                'status' => 'success', // Giả lập thanh toán luôn thành công
                'transaction_code' => 'TXN' . strtoupper(Str::random(10)),
            ]);

            // 2. Cập nhật trạng thái Booking
            $booking->update(['status' => 'paid']);

            // 3. Sinh vé điện tử (Tickets) từ các ghế đã khóa
            $seatLocks = $booking->seatLocks;
            foreach ($seatLocks as $lock) {
                Ticket::create([
                    'booking_id' => $booking->id,
                    'trip_id' => $booking->trip_id,
                    'seat_id' => $lock->seat_id,
                    'ticket_code' => 'TKT-' . strtoupper(Str::random(8)),
                    'status' => 'confirmed',
                ]);
            }

            DB::commit();
            return redirect()->route('customer.bookings.show', $booking->id)
                             ->with('success', 'Thanh toán thành công. Vé của bạn đã được xuất.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi thanh toán: ' . $e->getMessage());
        }
    }
}