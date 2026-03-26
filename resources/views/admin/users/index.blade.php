@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Người dùng')

@section('content-main')
<<<<<<< HEAD
    <div class="top-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <small style="color: #666;">Tổng: {{ $users->total() }} người dùng</small>
        </div>
    </div>

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">

        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f2f5;">
                    <th style="padding:16px;">ID</th>
                    <th style="padding:16px;">Người dùng</th>
                    <th style="padding:16px;">Vai trò</th>
                    <th style="padding:16px;">Trạng thái</th>
                    <th style="padding:16px;">Email / Phone</th>
                    <th style="padding:16px;">Ngày tạo</th>
                    <th style="padding:16px; text-align:center;">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr style="border-bottom: 1px solid #f0f2f5;">

                        {{-- ID --}}
                        <td style="padding:16px;">#{{ $user->id }}</td>

                        {{-- User --}}
                        <td style="padding:16px;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <img src="{{ $user->avatar ?? 'https://via.placeholder.com/40' }}"
                                    style="width:40px; height:40px; border-radius:50%;">
                                <div>
                                    <div style="font-weight:600;">{{ $user->name }}</div>
                                    <small style="color:#999;">ID: {{ $user->id }}</small>
                                </div>
                            </div>
                        </td>

                        {{-- Role --}}
                        <td style="padding:16px;">
                            <span
                                style="
                                padding:4px 10px;
                                border-radius:6px;
                                font-size:12px;
                                font-weight:600;
                                color:white;
                                background:
                                    {{ $user->role === 'admin' ? '#ff4d4f' : ($user->role === 'staff' ? '#faad14' : '#1890ff') }};
                            ">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td style="padding:16px;">
                            <span
                                style="
                                padding:4px 10px;
                                border-radius:6px;
                                font-size:12px;
                                font-weight:600;
                                color:white;
                                background:
                                    {{ $user->status === 'active' ? '#52c41a' : '#ff4d4f' }};
                            ">
                                {{ $user->status === 'active' ? 'Hoạt động' : 'Đã chặn' }}
                            </span>
                        </td>

                        {{-- Contact --}}
                        <td style="padding:16px;">
                            {{ $user->email ?? '-' }} <br>
                            <small>{{ $user->phone ?? '-' }}</small>
                        </td>

                        {{-- Created --}}
                        <td style="padding:16px; color:#999;">
                            {{ $user->created_at->diffForHumans() }}
                        </td>

                        {{-- Actions --}}
                        <td style="padding:16px; text-align:center;">

                            {{-- Xem --}}
                            <a href="{{ route('admin.users.show', $user) }}"
                                style="background:#e6f7ff; color:#1890ff; padding:6px 12px; border-radius:6px; font-size:12px; font-weight:600; text-decoration:none; margin-right:6px;">
                                Xem
                            </a>

                            {{-- Toggle status --}}
                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    style="
                                        padding:6px 12px;
                                        border:none;
                                        border-radius:6px;
                                        font-size:12px;
                                        font-weight:600;
                                        cursor:pointer;
                                        background:
                                            {{ $user->status === 'active' ? '#fff1f0' : '#f6ffed' }};
                                        color:
                                            {{ $user->status === 'active' ? '#cf1322' : '#389e0d' }};
                                    ">
                                    {{ $user->status === 'active' ? 'Chặn' : 'Mở' }}
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:32px; text-align:center; color:#999;">
                            Không có người dùng nào
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <div style="margin-top:20px; display:flex; justify-content:center;">
        {{ $users->links() }}
    </div>
@endsection
=======
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
>>>>>>> 9c9ec7d6db15ce235832f97d90478d9c32b652ce
