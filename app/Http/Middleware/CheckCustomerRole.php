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
            if (Auth::user()->role === 'customer' && !Auth::user()->hasVerifiedEmail()) {
                return redirect()->route('verification.notice')->with('error', 'Vui lòng xác nhận email trước khi tiếp tục.');
            }
            return $next($request);
        }

        return redirect('/')->with('error', 'Tài khoản của bạn không có quyền truy cập.');
    }
}
