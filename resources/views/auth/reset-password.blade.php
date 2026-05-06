@extends('layout.AuthLayout')

@section('title', 'Tạo mật khẩu mới')

@section('content')
    <div style="text-align: center; margin-bottom: 24px;">
        <h3 style="margin-bottom: 8px; color: var(--text-primary);">Tạo mật khẩu mới</h3>
        <p style="color: var(--text-secondary); font-size: 14px;">
            Vui lòng nhập mật khẩu mới cho tài khoản của bạn.
        </p>
    </div>

    {{-- LỖI VALIDATE --}}
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

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="form-group mb-3">
            <label class="form-label">Email của bạn</label>
            <div class="input-group">
                <input type="email" name="email" class="form-control" 
                       value="{{ $email ?? old('email') }}" required readonly>
                <i class='bx bx-envelope input-icon'></i>
            </div>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Mật khẩu mới</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" 
                       placeholder="Nhập ít nhất 6 ký tự" required autofocus>
                <i class='bx bx-lock-alt input-icon'></i>
            </div>
        </div>

        <div class="form-group mb-4">
            <label class="form-label">Xác nhận mật khẩu</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" class="form-control" 
                       placeholder="Nhập lại mật khẩu mới" required>
                <i class='bx bx-lock-alt input-icon'></i>
            </div>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; margin-top: 16px;">
            Cập nhật mật khẩu
        </button>
    </form>
@endsection
