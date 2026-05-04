@extends('layout.admin.AdminLayout')

@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h3 class="fw-bold mb-4">{{{ __('update') }} thông tin</h3>
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Họ tên</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control rounded-3">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">{{{ __('email') }}</label>
                        <input type="text" value="{{ $user->email }}" class="form-control rounded-3" disabled>
                        <small class="text-muted">Không thể thay đổi email hệ thống.</small>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">{{{ __('role') }}</label>
                            <select name="role" class="form-select rounded-3">
                                <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">{{{ __('status') }}</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>{{{ __('active') }}</option>
                                <option value="blocked" {{ $user->status == 'blocked' ? 'selected' : '' }}>Khóa tài khoản</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-primary" style="background: #ff6b00; border:none; border-radius: 10px; padding: 10px 20px;">{{{ __('update') }}</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light border" style="border-radius: 10px; padding: 10px 20px;">{{{ __('back') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection