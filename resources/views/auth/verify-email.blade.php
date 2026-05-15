@extends('layout.AuthLayout')

@section('title', 'Xác thực Email')
@section('auth_title', 'Xác minh tài khoản')
@section('auth_subtitle', 'Cảm ơn bạn đã đăng ký! Để bảo mật, vui lòng xác nhận địa chỉ email của bạn.')

@section('content')
    <div class="mb-8">
        <div class="bg-brand-primary/10 border border-brand-primary/20 rounded-2xl p-6 text-center">
            <div class="w-16 h-16 bg-brand-primary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="mail-check" class="w-8 h-8 text-brand-primary"></i>
            </div>
            <p class="text-white/80 text-sm leading-relaxed mb-4">
                Chúng tôi đã gửi một liên kết xác thực đến email của bạn. Vui lòng kiểm tra hộp thư đến (và hộp thư rác) để hoàn tất đăng ký.
            </p>
            <p class="text-white/60 text-xs">
                Nếu bạn không nhận được email, bạn có thể yêu cầu gửi lại bên dưới.
            </p>
        </div>
    </div>

    {{-- THÔNG BÁO THÀNH CÔNG --}}
    @if (session('success'))
        <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl flex items-center gap-2 text-sm font-medium mb-6">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.verify') }}" class="space-y-4">
            @csrf
            
            <div class="space-y-2">
                <label class="block text-sm font-medium text-white/70 ml-1 text-center">Mã xác thực (6 số)</label>
                <div class="relative group max-w-xs mx-auto">
                    <input type="text" name="code" maxlength="6" pattern="\d{6}" class="w-full bg-white/5 border border-white/10 rounded-xl py-4 text-center text-2xl tracking-[0.5em] text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all font-mono" placeholder="------" required autofocus>
                </div>
            </div>

            <button type="submit" class="w-full liquid-gradient hover:scale-[1.02] active:scale-[0.98] transition-all py-3.5 rounded-xl text-white font-bold text-lg flex items-center justify-center gap-2 shadow-lg shadow-brand-primary/20">
                Xác thực ngay
                <i data-lucide="check-circle" class="w-5 h-5"></i>
            </button>
        </form>

        <div class="relative flex items-center py-2">
            <div class="flex-grow border-t border-white/10"></div>
            <span class="flex-shrink-0 mx-4 text-white/40 text-sm">Hoặc</span>
            <div class="flex-grow border-t border-white/10"></div>
        </div>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-white/5 hover:bg-white/10 border border-white/10 transition-all py-3.5 rounded-xl text-white/80 font-bold flex items-center justify-center gap-2">
                <i data-lucide="send" class="w-5 h-5"></i>
                Gửi lại mã xác nhận
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full bg-transparent hover:text-red-400 transition-all py-2 rounded-xl text-white/50 text-sm font-medium flex items-center justify-center gap-2">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                Đăng xuất
            </button>
        </form>
    </div>
@endsection
