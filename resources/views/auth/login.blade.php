@extends('layout.AuthLayout')

@section('title', 'Đăng nhập')

@section('content')
    {{-- THÔNG BÁO THÀNH CÔNG --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-1'></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- THÔNG BÁO LỖI HỆ THỐNG/LOGIN --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class='bx bx-error-circle me-1'></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- LỖI VALIDATE (Ví dụ: sai định dạng email) --}}
    @if ($errors->any())
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
            <label class="form-label">Email</label>
            <div class="input-group">
                {{-- Giữ lại email cũ nếu đăng nhập sai mật khẩu bằng old('email') --}}
                <input type="email" name="email" class="form-control" 
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
                {{-- Giữ trạng thái checkbox nếu có lỗi reload trang --}}
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span style="color: var(--text-secondary);">Ghi nhớ đăng nhập</span>
            </label>
            <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%;">
            Đăng nhập hệ thống
        </button>

        <div style="margin: 20px 0; display: flex; align-items: center; justify-content: center; gap: 10px;">
            <hr style="flex: 1; border: none; border-top: 1px solid #dee2e6;">
            <span style="color: var(--text-secondary); font-size: 14px;">Hoặc</span>
            <hr style="flex: 1; border: none; border-top: 1px solid #dee2e6;">
        </div>

        <a href="{{ route('login.google') }}" class="btn" style="width: 100%; display: flex; justify-content: center; align-items: center; gap: 10px; padding: 12px; border-radius: 8px; font-weight: 500; background: #fff; border: 1px solid #dee2e6; color: #333; text-decoration: none; transition: 0.2s;">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" style="width: 20px;">
            Đăng nhập bằng Google
        </a>

        <div class="auth-links" style="justify-content: center; margin-top: 32px;">
            <span>Chưa có tài khoản? <a href="{{ route('register') }}" class="text-link">Đăng ký ngay</a></span>
        </div>
    </form>
@endsection