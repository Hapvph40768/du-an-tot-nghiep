<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Xem danh sách dòng tiền giao dịch
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->paginate(20);
        return view('admin.transactions.index', compact('transactions'));
    }

    // Xem danh sách các đơn hàng (Orders tổng)
    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    // Xem chi tiết 1 giao dịch
    public function showTransaction(Transaction $transaction)
    {
        return view('admin.transactions.show', compact('transaction'));
    }

    // (Tùy chọn) Cập nhật trạng thái đơn hàng nếu cần đối soát thủ công bằng tay
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed,cancelled,waiting_verify',
        ]);

        $order->update(['status' => $request->status]);
        return back()->with('success', 'Đã cập nhật trạng thái thanh toán.');
    }
}