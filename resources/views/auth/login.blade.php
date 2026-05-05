@extends('layout.AuthLayout')

@section('title', 'Đăng nhập')

@section('content')
    {{-- THÔNG BÁO THÀNH CÔNG --}} @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-1'></i>
            {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- THÔNG BÁO LỖI HỆ THỐNG/LOGIN --}} @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class='bx bx-error-circle me-1'></i>
            {{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- LỖI VALIDATE (Ví dụ: sai định dạng email) --}} @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="post" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">{{ __('email') }}</label>
            <div class="input-group">
                {{-- Giữ lại email cũ nếu đăng nhập sai mật khẩu bằng old('email') --}}<input type="email" name="email" class="form-control" 
                       placeholder="phamvana@gmail.com" value="{{ old('email') }}" 
                       required autofocus>
                <i class='bx bx-user input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Mật khẩu</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" 
                       placeholder="••••••••" required>
                <i class='bx bx-lock-alt input-icon'></i>
            </div>
        </div>

        <div class="auth-links" style="margin-bottom: 24px;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                {{-- Giữ trạng thái checkbox nếu có lỗi reload trang --}}<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span style="color: var(--text-secondary);">{{ __('persist_session') }}</span>
            </label>
            <a href="#">{{ __('recovery_protocol') }}</a>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%;">
            Đăng nhập hệ thống
        </button>

        <div class="auth-links" style="justify-content: center; margin-top: 32px;">
            <span>{{ __('identity_not_found') }}<a href="{{ route('register') }}" class="text-link">{{ __('register') }} ngay</a></span>
        </div>
    </form>
@endsection