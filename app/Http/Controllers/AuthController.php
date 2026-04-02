<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone'    => 'required|unique:users',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'customer',
        ]);

        return redirect()->route('login')
            ->with('success', 'Đăng ký thành công, mời đăng nhập.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin' || $user->role === 'staff') {
                return redirect()->route('admin.dashboard.index')
                    ->with('success', 'Chào mừng quay lại Admin!');
            }

            if ($user->role === 'assistant') {
                return redirect()->route('assistant.trips.index')
                    ->with('success', 'Chào mừng Phụ xe! Vui lòng chọn chuyến.');
            }

            if ($user->role === 'driver') {
                return redirect()->route('driver.home')
                    ->with('success', 'Chúc bạn có những chuyến đi thuận lợi (Tài xế)!');
            }

            return redirect()->route('customer.home')
                ->with('success', 'Đăng nhập thành công!');
        }

        return back()
            ->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Bạn đã đăng xuất thành công.');
    }
}
