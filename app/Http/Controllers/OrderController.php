<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // public function index()
    // {
    //     $orders = Order::where('user_id', Auth::id() ?? 1) // Fallback 1 cho dev local theo luồng trước đó
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(10);

    //     return view('orders.index', compact('orders'));
    // }

    // test 
    public function index()
    {
        // TẠM THỜI: Bỏ điều kiện where user_id để hiển thị toàn bộ đơn hàng test UI
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('orders.index', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.show', compact('order'));
    }
}
