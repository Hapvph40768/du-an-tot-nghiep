@extends('layout.admin')

@section('header-title', 'Quản lý Tài khoản')
@section('header-subtitle', 'Phân quyền và quản lý người dùng hệ thống')

@section('content-main')
<div class="container-fluid px-0">
    <!-- Header Summary -->
    <div class="card border-0 mb-4 p-4 dash-card">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
            <div class="d-flex align-items-center gap-4">
                <div class="dash-icon-bg" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; width: 60px; height: 60px;">
                    <i class='bx bx-group fs-1'></i>
                </div>
                <div>
                    <h3 class="fw-bold text-dark mb-1">NGƯỜI DÙNG</h3>
                    <p class="text-muted small fw-bold text-uppercase mb-0" style="letter-spacing: 1px;">Hệ thống có {{ $users->total() }} thành viên</p>
                </div>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="bg-light px-4 py-2 rounded-3 border text-center">
                    <p class="text-success small fw-bold text-uppercase mb-0" style="letter-spacing: 1px;">Active</p>
                    <p class="fw-bold text-dark fs-5 mb-0">{{ $users->where('status', 'active')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success d-flex align-items-center mb-4 border-0 shadow-sm" style="border-radius: 12px;">
        <i class='bx bx-check-circle fs-4 me-2'></i>
        <div class="fw-bold">{{ session('success') }}</div>
    </div>
    @endif

    <!-- Table Container -->
    <div class="card border-0 p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Họ tên / Email</th>
                        <th>Vai Trò</th>
                        <th>Liên Hệ</th>
                        <th>Trạng Thái</th>
                        <th class="text-end pe-4">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-dark">{{ $user->name }}</span>
                                <span class="text-muted small">{{ $user->email }}</span>
                            </div>
                        </td>
                        <td>
                            @php
                                $roleConfig = [
                                    'admin' => ['bg' => 'danger', 'label' => 'Quản trị'],
                                    'staff' => ['bg' => 'warning', 'label' => 'Nhân viên'],
                                    'customer' => ['bg' => 'secondary', 'label' => 'Khách hàng'],
                                ][$user->role] ?? ['bg' => 'secondary', 'label' => $user->role];
                            @endphp
                            <span class="badge bg-{{ $roleConfig['bg'] }} bg-opacity-10 text-{{ $roleConfig['bg'] }} border border-{{ $roleConfig['bg'] }} border-opacity-25">
                                {{ $roleConfig['label'] }}
                            </span>
                        </td>
                        <td>
                            <span class="text-dark fw-bold">{{ $user->phone ?? '—' }}</span>
                        </td>
                        <td>
                            @if($user->status == 'active')
                                <div class="d-flex align-items-center gap-2 text-success fw-bold small">
                                    <i class='bx bxs-circle' style="font-size: 8px;"></i>
                                    <span>Đang chạy</span>
                                </div>
                            @else
                                <div class="d-flex align-items-center gap-2 text-danger fw-bold small">
                                    <i class='bx bxs-circle' style="font-size: 8px;"></i>
                                    <span>Đã khóa</span>
                                </div>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-light border text-primary" title="Cài đặt">
                                    <i class='bx bx-cog'></i>
                                </a>
                                <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-light border {{ $user->status === 'active' ? 'text-danger' : 'text-success' }}" title="Khóa/Mở khóa">
                                        <i class='bx bx-{{ $user->status === 'active' ? 'lock-alt' : 'lock-open-alt' }}'></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Xác nhận xóa tài khoản?')" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger" title="Xóa">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted mb-2"><i class='bx bx-search fs-1'></i></div>
                            <p class="fw-bold text-muted mb-0">Không tìm thấy dữ liệu phù hợp</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center p-4">
            <small class="text-muted fw-bold">Hiển thị {{ $users->count() }} / {{ $users->total() }} người dùng</small>
            <div>
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
