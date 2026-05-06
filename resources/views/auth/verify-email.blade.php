@extends('layout.AuthLayout')

@section('title', 'Xác thực Email')

@section('content')
    <div style="text-align: center; margin-bottom: 24px;">
        <h3 style="margin-bottom: 8px; color: var(--text-primary);">Xác thực Email của bạn</h3>
        <p style="color: var(--text-secondary); font-size: 15px; line-height: 1.5;">
            Cảm ơn bạn đã đăng ký tài khoản! Trước khi bắt đầu sử dụng các tính năng đặt vé chuyên sâu, 
            bạn vui lòng xác nhận địa chỉ email bằng cách nhấp vào liên kết mà chúng tôi vừa gửi qua email cho bạn.
        </p>
        <p style="color: var(--text-secondary); font-size: 14px; margin-top: 10px;">
            Nếu bạn không nhận được email, chúng tôi có thể gửi lại một liên kết khác.
        </p>
    </div>

    {{-- THÔNG BÁO THÀNH CÔNG --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-1'></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div style="display: flex; flex-direction: column; gap: 12px; align-items: center; margin-top: 24px;">
        <form method="POST" action="{{ route('verification.send') }}" style="width: 100%;">
            @csrf
            <button type="submit" class="btn-primary" style="width: 100%;">
                <i class='bx bx-envelope'></i> Gửi lại Email xác nhận
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
            @csrf
            <button type="submit" style="width: 100%; border: 1px solid #ccc; background: white; padding: 12px; border-radius: 8px; cursor: pointer; color: #555; text-transform: uppercase; font-weight: 600; font-size: 14px;">
                Đăng xuất
            </button>
        </form>
    </div>
@endsection
