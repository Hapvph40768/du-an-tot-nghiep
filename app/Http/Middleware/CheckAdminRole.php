<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle($request, Closure $next)
    {
        // Chỉ khi đã đăng nhập (Auth::check) mới được đọc thuộc tính role
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Nếu chưa đăng nhập hoặc sai role, đẩy về trang login
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập với quyền Admin.');
    }
}
