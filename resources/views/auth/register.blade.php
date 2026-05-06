@extends('layout.AuthLayout')

@section('title', 'Đăng ký tài khoản')

@section('content')
    {{-- VALIDATE ERROR --}}
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

    <form method="post" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Họ và tên</label>
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Nguyễn Văn A" value="{{ old('name') }}" required>
                <i class='bx bx-id-card input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <div class="input-group">
                <input type="email" name="email" class="form-control" placeholder="nguyenvana@gmail.com" value="{{ old('email') }}" required>
                <i class='bx bx-envelope input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Số điện thoại</label>
            <div class="input-group">
                <input type="text" name="phone" class="form-control" placeholder="0987654321" value="{{ old('phone') }}" required>
                <i class='bx bx-phone input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Mật khẩu</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                <i class='bx bx-lock-alt input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Xác nhận mật khẩu</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                <i class='bx bx-check-shield input-icon'></i>
            </div>
        </div>



        <button type="submit" class="btn-primary" style="width: 100%; margin-top: 16px;">
            Tạo tài khoản mới
        </button>

        <div style="margin: 20px 0; display: flex; align-items: center; justify-content: center; gap: 10px;">
            <hr style="flex: 1; border: none; border-top: 1px solid #dee2e6;">
            <span style="color: var(--text-secondary); font-size: 14px;">Hoặc đăng ký nhanh bằng</span>
            <hr style="flex: 1; border: none; border-top: 1px solid #dee2e6;">
        </div>

        <a href="{{ route('login.google') }}" class="btn" style="width: 100%; display: flex; justify-content: center; align-items: center; gap: 10px; padding: 12px; border-radius: 8px; font-weight: 500; background: #fff; border: 1px solid #dee2e6; color: #333; text-decoration: none; transition: 0.2s;">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" style="width: 20px;">
            Đăng nhập bằng Google
        </a>

        <div class="auth-links" style="justify-content: center; margin-top: 32px;">
            <span>Đã có tài khoản? <a href="{{ route('login') }}" class="text-link">Đăng nhập</a></span>
        </div>
    </form>
@endsection