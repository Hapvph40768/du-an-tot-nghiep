<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * KHÁCH HÀNG: XEM DANH SÁCH ĐƠN CỦA MÌNH
     */
    public function index()
    {
        // Chỉ lấy các đơn hàng thuộc về user đang đăng nhập (hoặc user 1 nếu đang test local)
        $orders = Order::where('user_id', Auth::id() ?? 1)
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * KHÁCH HÀNG: XEM CHI TIẾT ĐƠN CỦA MÌNH
     */
    public function show($id)
    {
        // Phải đúng ID đơn và đúng User đó mới được xem
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id() ?? 1)
                      ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    /**
     * HIỂN THỊ FORM SỬA ĐƠN HÀNG (Nếu có dùng đến view edit riêng)
     */
    public function edit($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id() ?? 1)
                      ->firstOrFail();

        return view('orders.edit', compact('order'));
    }

    /**
     * CẬP NHẬT ĐƠN HÀNG (Sửa lỗi Call to undefined method update)
     */
    public function update(Request $request, $id)
    {
        // 1. Validate dữ liệu đầu vào
        $request->validate([
            'amount'         => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'status'         => 'required|string',
        ]);

        // 2. Tìm đơn hàng (Đảm bảo chỉ cập nhật đơn của chính user này)
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id() ?? 1)
                      ->firstOrFail();

        // 3. Thực hiện cập nhật
        $order->update([
            'amount'         => $request->amount,
            'payment_method' => $request->payment_method,
            'status'         => $request->status,
        ]);

        // 4. Trả về trang chi tiết kèm thông báo
        return redirect()->route('orders.show', $order->id)
                         ->with('success', '🎉 Đã cập nhật đơn hàng thành công!');
    }

    /**
     * KHÁCH HÀNG: XÓA / HỦY ĐƠN HÀNG
     */
    public function destroy($id)
    {
        // Đảm bảo chỉ được xóa đơn của chính mình
        $order = Order::where('id', $id)
                      ->where('user_id', Auth::id() ?? 1)
                      ->firstOrFail();
                      
        $order->delete();

        return redirect()->route('orders.index')
                         ->with('success', '🗑️ Đã xóa đơn hàng thành công!');
    }
}