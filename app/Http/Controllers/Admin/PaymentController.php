<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking.user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.payments.index', compact('payments'));
    }

    // Admin xác nhận thanh toán thủ công (VD: Khách đưa tiền mặt)
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,success,failed',
        ]);

        DB::beginTransaction();
        try {
            $payment->update(['status' => $validated['status']]);

            // Nếu thanh toán thành công, tự động cập nhật Booking thành 'paid'
            if ($validated['status'] === 'success' && $payment->booking) {
                $payment->booking->update(['status' => 'paid']);
            }

            DB::commit();
            return back()->with('success', 'Đã cập nhật trạng thái thanh toán.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}