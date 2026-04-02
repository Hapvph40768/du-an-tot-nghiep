<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckDriverRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'driver') {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập với quyền Tài xế hoặc Phụ xe.');
    }
}
