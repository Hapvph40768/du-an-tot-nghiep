<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCustomerRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem đã đăng nhập chưa và có phải role 'customer' không
        if (Auth::check() && Auth::user()->role === 'customer') {
            return $next($request);
        }

        // Nếu là admin/staff hoặc chưa đăng nhập, đẩy về trang login kèm thông báo
        Auth::logout();
        return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập khu vực khách hàng.');
    }
}