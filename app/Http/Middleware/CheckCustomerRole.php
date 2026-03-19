<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCustomerRole
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }

        // Cho phép cả admin và staff thực hiện chức năng booking để test
        if (in_array(Auth::user()->role, ['customer', 'admin', 'staff'])) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Tài khoản của bạn không có quyền truy cập.');
    }
}
