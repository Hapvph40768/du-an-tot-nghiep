@extends('layout.AuthLayout')

@section('title', 'Đăng ký tài khoản')

@section('content')
    {{-- VALIDATE ERROR --}}} @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}}</li>
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
            <label class="form-label">{{{ __('email') }}</label>
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
            <label class="form-label">{{{ __('confirm') }} mật khẩu</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                <i class='bx bx-check-shield input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Bạn đăng ký với vai trò gì?</label>
            <div class="input-group">
                <select name="role" class="form-control" required style="padding-left: 45px; appearance: auto;">
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Khách hàng</option>
                    <option value="driver" {{ old('role') == 'driver' ? 'selected' : '' }}>{{{ __('drivers') }}</option>
                </select>
                <i class='bx bx-briefcase input-icon'></i>
            </div>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; margin-top: 16px;">
            Tạo tài khoản mới
        </button>

        <div class="auth-links" style="justify-content: center; margin-top: 32px;">
            <span>{{{ __('already_active') }}<a href="{{ route('login') }}" class="text-link">{{{ __('login') }}</a></span>
        </div>
    </form>
@endsection