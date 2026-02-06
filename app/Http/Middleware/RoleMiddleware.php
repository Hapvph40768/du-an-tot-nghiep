<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Chưa đăng nhập
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role;

        // Không đúng role
        if (!in_array($userRole, $roles)) {
            abort(403, 'Bạn không có quyền truy cập');
        }

        return $next($request);
    }
}
