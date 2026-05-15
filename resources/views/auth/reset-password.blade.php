@extends('layout.AuthLayout')

@section('title', 'Tạo mật khẩu mới')
@section('auth_title', 'Tạo mật khẩu mới')
@section('auth_subtitle', 'Vui lòng nhập mật khẩu mới cho tài khoản của bạn.')

@section('content')
    {{-- LỖI VALIDATE --}}
    @if ($errors->any())
        <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl flex items-start gap-2 text-sm font-medium mb-6">
            <i data-lucide="alert-circle" class="w-4 h-4 mt-0.5"></i>
            <ul class="list-disc pl-4 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        
        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1 text-center">Mã xác nhận (6 số)</label>
            <div class="relative group max-w-xs mx-auto">
                <input type="text" name="code" maxlength="6" pattern="\d{6}" class="w-full bg-white/5 border border-white/10 rounded-xl py-4 text-center text-2xl tracking-[0.5em] text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all font-mono" placeholder="------" required autofocus>
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Email của bạn</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
                <input type="email" name="email" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white/50 cursor-not-allowed focus:outline-none" value="{{ $email ?? old('email') }}" required readonly>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Mật khẩu mới</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                    <i data-lucide="lock" class="w-5 h-5"></i>
                </div>
                <input type="password" name="password" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="Ít nhất 6 ký tự" required>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Xác nhận mật khẩu</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <input type="password" name="password_confirmation" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="Nhập lại mật khẩu mới" required>
            </div>
        </div>

        <button type="submit" class="w-full liquid-gradient hover:scale-[1.02] active:scale-[0.98] transition-all py-3.5 rounded-xl text-white font-bold text-lg flex items-center justify-center gap-2 shadow-lg shadow-brand-primary/20 mt-4">
            Cập nhật mật khẩu
            <i data-lucide="check-circle" class="w-5 h-5"></i>
        </button>
    </form>
@endsection
