@extends('layout.AuthLayout')

@section('title', 'Quên mật khẩu')
@section('auth_title', 'Khôi phục mật khẩu')
@section('auth_subtitle', 'Vui lòng nhập địa chỉ email đã đăng ký. Chúng tôi sẽ gửi liên kết khôi phục.')

@section('content')
    {{-- THÔNG BÁO THÀNH CÔNG --}}
    @if (session('status'))
        <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl flex items-center gap-2 text-sm font-medium mb-6">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            {{ session('status') }}
        </div>
    @endif

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

    <form method="post" action="{{ route('password.email') }}" class="space-y-6">
        @csrf
        
        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Email của bạn</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
                <input type="email" name="email" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="phamvana@gmail.com" value="{{ old('email') }}" required autofocus>
            </div>
        </div>

        <button type="submit" class="w-full liquid-gradient hover:scale-[1.02] active:scale-[0.98] transition-all py-3.5 rounded-xl text-white font-bold text-lg flex items-center justify-center gap-2 shadow-lg shadow-brand-primary/20">
            Gửi liên kết khôi phục
            <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </button>

        <div class="text-center mt-8">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm text-white/60 hover:text-white transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay lại đăng nhập
            </a>
        </div>
    </form>
@endsection
