@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Người dùng')

@section('content-main')
<style>
    :root { --primary-color: #ff6b00; --primary-hover: #e65100; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; }
    .custom-table { width: 100%; border-collapse: separate; border-spacing: 0; table-layout: fixed; }
    .custom-table thead th { background-color: #f9fafb; color: #6b7280; font-weight: 600; font-size: 12px; text-transform: uppercase; padding: 16px; border-bottom: 2px solid #edf2f7; text-align: left; }
    .custom-table td { padding: 16px; vertical-align: middle; border-bottom: 1px solid #f3f4f6; text-align: left; font-size: 14px; }
    .btn-primary-custom { background-color: var(--primary-color); border: none; color: white; padding: 8px 18px; border-radius: 10px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: 0.3s; }
    .btn-primary-custom:hover { background-color: var(--primary-hover); color: white; transform: translateY(-2px); }
    .badge-role { padding: 5px 10px; border-radius: 8px; font-size: 11px; font-weight: 600; }
    .role-admin { background: #fee2e2; color: #dc2626; }
    .role-staff { background: #e0e7ff; color: #4338ca; }
    .role-customer { background: #f3f4f6; color: #374151; }
    .status-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 5px; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark m-0">Quản lý tài khoản</h2>
            <p class="text-muted small mb-0">Hệ thống có tổng cộng {{ $users->total() }} thành viên</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
            <i class='bx bx-check-circle'></i> {{ session('success') }}
        </div>
    @endif

    <div class="card-box">
        <div class="table-responsive">
            <table class="custom-table w-100">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 25%;">Họ tên / Email</th>
                        <th style="width: 15%;">Số điện thoại</th>
                        <th style="width: 15%;">Vai trò</th>
                        <th style="width: 15%;">Trạng thái</th>
                        <th style="width: 15%;">Ngày tạo</th>
                        <th class="text-end pe-4" style="width: 15%;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                                <div class="text-muted small">{{ $user->email }}</div>
                            </td>
                            <td>{{ $user->phone ?? '—' }}</td>
                            <td>
                                <span class="badge-role role-{{ $user->role }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                @if($user->status == 'active')
                                    <span class="text-success small fw-bold"><span class="status-dot bg-success"></span>Hoạt động</span>
                                @else
                                    <span class="text-danger small fw-bold"><span class="status-dot bg-danger"></span>Đã khóa</span>
                                @endif
                            </td>
                            <td class="text-muted small">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-light border" title="Sửa">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                    <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light border {{ $user->status === 'active' ? 'text-danger' : 'text-success' }}" title="{{ $user->status === 'active' ? 'Khóa' : 'Mở khóa' }}">
                                            <i class='bx {{ $user->status === "active" ? "bx-block" : "bx-check-circle" }}'></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Xóa người dùng này?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-light border text-danger" title="Xóa">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
