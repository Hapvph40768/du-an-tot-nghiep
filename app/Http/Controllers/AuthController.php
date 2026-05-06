<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'customer',
        ]);

        // Tự động đăng nhập và chuyển hướng trang chủ
        Auth::login($user);

        return redirect()->route('customer.home')->with('success', 'Đăng ký thành công!');
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

            // Chuyển hướng dựa trên Role
            if (Auth::user()->role === 'admin' || Auth::user()->role === 'staff') {
                return redirect()->intended('/admin');
            }

            if (Auth::user()->role === 'driver') {
                return redirect()->route('driver.home')
                    ->with('success', 'Chúc bạn có những chuyến đi thuận lợi!');
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

    // --- QUÊN MẬT KHẨU ---
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = \Illuminate\Support\Facades\Password::broker()->sendResetLink(
            $request->only('email')
        );

        return $status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = \Illuminate\Support\Facades\Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(\Illuminate\Support\Str::random(60));
                $user->save();
                event(new \Illuminate\Auth\Events\PasswordReset($user));
            }
        );

        return $status === \Illuminate\Support\Facades\Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    // --- GOOGLE SSO ---
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Tìm User bằng google_id HOẶC bằng email
            $user = User::where('google_id', $googleUser->id)
                        ->orWhere('email', $googleUser->email)
                        ->first();

            if ($user) {
                // Nếu User tồn tại nhưng chưa có google_id thì cập nhật thêm
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                        'email_verified_at' => now(), // Đánh dấu đã xác thực nếu dùng Google
                    ]);
                }
            } else {
                // Tạo User mới (password để trống)
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'role' => 'customer',
                    'avatar' => $googleUser->avatar
                ]);
            }

            Auth::login($user);
            return redirect()->route('customer.home')->with('success', 'Đăng nhập Google thành công!');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Đăng nhập Google thất bại: ' . $e->getMessage()]);
        }
    }
}
