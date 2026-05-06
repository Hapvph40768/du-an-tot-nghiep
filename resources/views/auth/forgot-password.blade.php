@extends('layout.AuthLayout')

@section('title', 'Quên mật khẩu')

@section('content')
    <div style="text-align: center; margin-bottom: 24px;">
        <h3 style="margin-bottom: 8px; color: var(--text-primary);">Khôi phục mật khẩu</h3>
        <p style="color: var(--text-secondary); font-size: 14px;">
            Vui lòng nhập địa chỉ email bạn đã sử dụng để đăng ký. Chúng tôi sẽ gửi một liên kết để thiết lập lại mật khẩu.
        </p>
    </div>

    {{-- THÔNG BÁO THÀNH CÔNG --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-1'></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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

    <form method="post" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Email của bạn</label>
            <div class="input-group">
                <input type="email" name="email" class="form-control" 
                       placeholder="phamvana@gmail.com" value="{{ old('email') }}" 
                       required autofocus>
                <i class='bx bx-envelope input-icon'></i>
            </div>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; margin-top: 16px;">
            Gửi liên kết khôi phục
        </button>

        <div class="auth-links" style="justify-content: center; margin-top: 32px;">
            <span><a href="{{ route('login') }}" class="text-link"><i class='bx bx-arrow-back'></i> Quay lại đăng nhập</a></span>
        </div>
    </form>
@endsection
