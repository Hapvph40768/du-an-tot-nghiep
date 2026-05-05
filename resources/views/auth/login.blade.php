@extends('layout.AuthLayout')

@section('title', 'Đăng nhập')
@section('auth_title', 'Chào mừng trở lại')
@section('auth_subtitle', 'Vui lòng nhập thông tin để truy cập hệ thống')

@section('content')
    <div class="space-y-6">
        {{-- THÔNG BÁO --}}
        @if (session('success') || session('error') || $errors->any())
            <div class="space-y-3">
                @if (session('success'))
                    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm animate-in fade-in slide-in-from-top-4 duration-500">
                        <i data-lucide="check-circle" class="w-5 h-5 shrink-0"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="flex items-center gap-3 p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm animate-in fade-in slide-in-from-top-4 duration-500">
                        <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-amber-400 text-sm animate-in fade-in slide-in-from-top-4 duration-500">
                        <div class="flex items-center gap-3 mb-2">
                            <i data-lucide="help-circle" class="w-5 h-5 shrink-0"></i>
                            <p class="font-bold">Lỗi nhập liệu:</p>
                        </div>
                        <ul class="space-y-1 ml-8 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        <form method="post" action="{{ route('login') }}" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label class="text-xs font-bold text-white/40 uppercase tracking-widest ml-1">Địa chỉ Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none group-focus-within:text-brand-accent text-white/20 transition-colors">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-white/[0.03] border border-white/10 rounded-2xl pl-12 pr-5 py-4 text-white placeholder:text-white/10 focus:outline-none focus:border-brand-accent focus:bg-white/[0.05] transition-all"
                           placeholder="yourname@example.com">
                </div>
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between ml-1">
                    <label class="text-xs font-bold text-white/40 uppercase tracking-widest">Mật khẩu</label>
                    <a href="#" class="text-xs font-bold text-brand-accent hover:underline uppercase tracking-widest">Quên mật khẩu?</a>
                </div>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none group-focus-within:text-brand-accent text-white/20 transition-colors">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                    </div>
                    <input type="password" name="password" required
                           class="w-full bg-white/[0.03] border border-white/10 rounded-2xl pl-12 pr-5 py-4 text-white placeholder:text-white/10 focus:outline-none focus:border-brand-accent focus:bg-white/[0.05] transition-all"
                           placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center ml-1">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                           class="w-5 h-5 rounded-lg bg-white/5 border-white/10 text-brand-accent focus:ring-brand-accent transition-all">
                    <span class="text-sm text-white/40 group-hover:text-white/60 transition-colors">Ghi nhớ đăng nhập</span>
                </label>
            </div>

            <button type="submit" 
                    class="w-full py-5 rounded-2xl liquid-gradient font-black text-lg shadow-xl shadow-brand-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3 group">
                <span>ĐĂNG NHẬP NGAY</span>
                <i data-lucide="arrow-right" class="w-6 h-6 group-hover:translate-x-1 transition-transform"></i>
            </button>
        </form>

        <div class="pt-8 text-center border-t border-white/5">
            <p class="text-white/40 font-medium">
                Bạn chưa có tài khoản? 
                <a href="{{ route('register') }}" class="text-brand-accent font-black hover:underline ml-2">ĐĂNG KÝ NGAY</a>
            </p>
        </div>
    </div>
@endsection