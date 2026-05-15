<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use App\Mail\PasswordResetCodeMail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\Registered;

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

        // Tạo mã xác nhận 6 số
        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->email_verification_code = $code;
        $user->email_verification_expires_at = now()->addMinutes(15);
        $user->save();

        // Gửi email OTP (bọc trong try-catch để tránh lỗi sập trang nếu cấu hình SMTP sai)
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($code));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Gửi email OTP thất bại: " . $e->getMessage());
            // Vẫn tiếp tục cho phép đăng nhập và chuyển hướng
        }

        // Tự động đăng nhập và chuyển hướng trang xác thực
        Auth::login($user);

        return redirect()->route('verification.notice')->with('success', 'Đăng ký thành công! Vui lòng xác thực email.');
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

    // --- XÁC THỰC EMAIL BẰNG MÃ OTP ---
    public function verifyEmailForm()
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('customer.home');
        }
        return view('auth.verify-email');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6'
        ]);

        $user = Auth::user();

        if ($user->email_verification_code !== $request->code) {
            return back()->withErrors(['code' => 'Mã xác thực không chính xác.']);
        }

        if (now()->greaterThan($user->email_verification_expires_at)) {
            return back()->withErrors(['code' => 'Mã xác thực đã hết hạn. Vui lòng yêu cầu gửi lại mã.']);
        }

        $user->email_verified_at = now();
        $user->email_verification_code = null;
        $user->email_verification_expires_at = null;
        $user->save();

        return redirect()->route('customer.home')->with('success', 'Xác thực tài khoản thành công!');
    }

    public function resendVerificationCode(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('customer.home');
        }

        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->email_verification_code = $code;
        $user->email_verification_expires_at = now()->addMinutes(15);
        $user->save();

        Mail::to($user->email)->send(new VerificationCodeMail($code));

        return back()->with('success', 'Mã xác thực mới đã được gửi tới email của bạn!');
    }

    // --- QUÊN MẬT KHẨU ---
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Chúng tôi không tìm thấy tài khoản nào với địa chỉ email này.']);
        }

        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->password_reset_code = $code;
        $user->password_reset_expires_at = now()->addMinutes(15);
        $user->save();

        Mail::to($user->email)->send(new PasswordResetCodeMail($code));

        return redirect()->route('password.reset', ['token' => 'code', 'email' => $user->email])
                         ->with('status', 'Mã khôi phục mật khẩu đã được gửi tới email của bạn!');
    }

    public function showResetForm(Request $request)
    {
        return view('auth.reset-password', ['email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|size:6',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Lỗi xác thực email.']);
        }

        if ($user->password_reset_code !== $request->code) {
            return back()->withErrors(['code' => 'Mã xác nhận không chính xác.']);
        }

        if (now()->greaterThan($user->password_reset_expires_at)) {
            return back()->withErrors(['code' => 'Mã xác nhận đã hết hạn. Vui lòng yêu cầu lại mã mới.']);
        }

        // Đổi mật khẩu
        $user->password = Hash::make($request->password);
        $user->password_reset_code = null;
        $user->password_reset_expires_at = null;
        $user->setRememberToken(Str::random(60));
        $user->save();

        event(new \Illuminate\Auth\Events\PasswordReset($user));

        return redirect()->route('login')->with('success', 'Mật khẩu đã được thiết lập lại thành công!');
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
