<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem đã đăng nhập chưa và có phải role 'admin' hoặc 'staff' không
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'staff'])) {
            return $next($request);
        }

        // Nếu là khách hàng hoặc chưa đăng nhập, đá về trang chủ hoặc login
        return redirect('/')->with('error', 'Bạn không có quyền truy cập trang quản trị.');
    }
}