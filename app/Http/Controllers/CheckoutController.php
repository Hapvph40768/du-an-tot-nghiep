<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Payment;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        return view('checkout');
    }

    public function processCheckout(Request $request)
    {
        $request->validate(['payment_method' => 'required|string']);

        try {
            DB::beginTransaction();

            // 1. Tạo Order
            $order = Order::create([
                'user_id' => 1,
                'order_code' => 'ORD-' . time(),
                'amount' => 50000, // Hardcode 50k theo yêu cầu
                'status' => 'pending',
                'payment_method' => $request->payment_method
            ]);

            // 2. Tạo Payment Record
            Payment::create([
                'order_id' => $order->id,
                'method' => $request->payment_method,
                'status' => 'pending'
            ]);

            DB::commit();

            // 3. Điều hướng theo phương thức
            return match($request->payment_method) {
                'vnpay' => app(PaymentController::class)->payWithVnpay($order),
                'bank_transfer' => redirect()->route('payment.bank_transfer', $order->id),
                'momo' => redirect()->route('payment.momo', $order->id),
                'zalopay' => redirect()->route('payment.zalopay', $order->id),
                default => redirect()->route('payment.cod', $order->id),
            };

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi khởi tạo đơn hàng: ' . $e->getMessage());
        }
    }
}