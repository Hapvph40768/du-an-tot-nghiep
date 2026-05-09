@extends('layout.AuthLayout')

@section('title', 'Đăng ký tài khoản')
@section('auth_title', 'Đăng Ký')
@section('auth_subtitle', 'Tạo tài khoản mới để trải nghiệm dịch vụ.')

@section('content')
    @if ($errors->any())
        <div class="bg-yellow-500/10 border border-yellow-500/50 text-yellow-400 px-4 py-3 rounded-xl text-sm font-medium">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('register') }}" class="space-y-5">
        @csrf
        
        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Họ và tên</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </div>
                <input type="text" name="name" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="Nguyễn Văn A" value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Email</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
                <input type="email" name="email" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="nguyenvana@gmail.com" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Số điện thoại</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                    <i data-lucide="phone" class="w-5 h-5"></i>
                </div>
                <input type="text" name="phone" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="0987654321" value="{{ old('phone') }}" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-white/70 ml-1">Mật khẩu</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                    </div>
                    <input type="password" name="password" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="••••••••" required>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-white/70 ml-1">Xác nhận MK</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                    </div>
                    <input type="password" name="password_confirmation" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="••••••••" required>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full liquid-gradient hover:scale-[1.02] active:scale-[0.98] transition-all py-3.5 rounded-xl text-white font-bold text-lg flex items-center justify-center gap-2 shadow-lg shadow-brand-primary/20 mt-4">
            Tạo tài khoản mới
            <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </button>

        <div class="relative flex items-center py-2 mt-4">
            <div class="flex-grow border-t border-white/10"></div>
            <span class="flex-shrink-0 mx-4 text-white/40 text-sm">Hoặc</span>
            <div class="flex-grow border-t border-white/10"></div>
        </div>

        <a href="{{ route('login.google') }}" class="w-full flex items-center justify-center gap-3 py-3.5 rounded-xl bg-white hover:bg-gray-100 transition-colors text-gray-900 font-semibold shadow-lg">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
            Đăng nhập bằng Google
        </a>

        <p class="text-center text-sm text-white/50 mt-6">
            Đã có tài khoản? <a href="{{ route('login') }}" class="text-brand-primary hover:text-white font-semibold transition-colors">Đăng nhập</a>
        </p>
    </form>
@endsection