<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureDriverProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'driver') {
            $user = Auth::user();
            $driver = $user->driver;

            // If driver record doesn't exist, or missing license_number or experience_years
            if (!$driver || empty($driver->license_number) || $driver->experience_years === null) {
                
                // Allow them to visit the edit and update routes, and logout
                if (!$request->routeIs('driver.profile.edit') && 
                    !$request->routeIs('driver.profile.update') && 
                    !$request->routeIs('logout')) {
                    
                    return redirect()->route('driver.profile.edit')
                        ->with('warning', 'Vui lòng cập nhật đầy đủ thông tin (chứng minh/bằng lái) để tiếp tục sử dụng hệ thống.');
                }
            }
        }

        return $next($request);
    }
}
