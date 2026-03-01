@extends('layout.admin.AdminLayout')

@section('content-main')
    <div class="container-fluid py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    <i class="bx bx-user-circle me-2 text-primary"></i>
                    Chi tiết Người dùng 
                </h3>
                <small class="text-muted">Quản lý thông tin tài khoản</small>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-arrow-back me-1"></i> Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="card shadow border-0 rounded-4 overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-4 text-center text-md-start">
                        <div class="position-relative d-inline-block mb-4">
                            <img src="{{ $user->avatar }}" 
                                 alt="{{ $user->name }}" 
                                 class="rounded-circle img-fluid shadow-lg border border-4 border-white"
                                 style="width: 180px; height: 180px; object-fit: cover;">
                            <span class="position-absolute bottom-0 end-0 translate-middle badge rounded-pill 
                                bg-{{ $user->status === 'active' ? 'success' : 'danger' }} border border-white border-3 p-2">
                                <span class="visually-hidden">Trạng thái</span>
                            </span>
                        </div>

                        <h4 class="fw-bold mb-1">{{ $user->name }}</h4>

                        <div class="d-flex justify-content-center justify-content-md-start gap-3 mb-4">
                            <span class="badge bg-primary-subtle text-primary px-4 py-2 fs-6">
                                {{ ucfirst($user->role) }}
                            </span>
                            <span class="badge bg-{{ $user->status === 'active' ? 'success-subtle text-success' : 'danger-subtle text-danger' }} px-4 py-2 fs-6">
                                {{ ucfirst($user->status) === 'Active' ? 'Hoạt động' : 'Bị chặn' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row g-4">
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-envelope fs-4 text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Email</small>
                                        <strong>{{ $user->email ?? 'Chưa cập nhật' }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-phone fs-4 text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Số điện thoại</small>
                                        <strong>{{ $user->phone ?? 'Chưa cập nhật' }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-calendar fs-4 text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Ngày tạo tài khoản</small>
                                        <strong>{{ $user->created_at->format('d/m/Y H:i') }}</strong>
                                        <small class="text-muted d-block mt-1">
                                            ({{ $user->created_at->diffForHumans() }})
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-time-five fs-4 text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted d-block">Cập nhật lần cuối</small>
                                        <strong>{{ $user->updated_at->format('d/m/Y H:i') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="alert alert-info bg-light border-0 mb-0" role="alert">
                            <i class="bx bx-info-circle me-2"></i>
                            Đây là thông tin cơ bản của người dùng.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection