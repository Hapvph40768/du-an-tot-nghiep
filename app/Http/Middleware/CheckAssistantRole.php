<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAssistantRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'assistant') {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập với quyền Phụ xe.');
    }
}
