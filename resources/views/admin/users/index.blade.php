@extends('layout.admin.AdminLayout')

@section('content-main')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-semibold"><i class="bx bx-user me-2 text-primary"></i> Quản lý Người dùng</h3>
            <small class="text-muted">Tổng: {{ $users->total() }} người dùng</small>
        </div>

        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Tìm tên, email, phone..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Tất cả vai trò</option>
                        <option value="admin"     {{ request('role') === 'admin'     ? 'selected' : '' }}>Admin</option>
                        <option value="staff"     {{ request('role') === 'staff'     ? 'selected' : '' }}>Staff</option>
                        <option value="customer"  {{ request('role') === 'customer'  ? 'selected' : '' }}>Customer</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active"  {{ request('status') === 'active'  ? 'selected' : '' }}>Active</option>
                        <option value="blocked" {{ request('status') === 'blocked' ? 'selected' : '' }}>Blocked</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Lọc</button>
                </div>
            </div>
        </form>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Người dùng</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Email / Phone</th>
                            <th>Ngày tạo</th>
                            <th class="text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>#{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle me-3" width="40" height="40">
                                        <div>
                                            <div class="fw-semibold">{{ $user->name }}</div>
                                            <small class="text-muted">ID: {{ $user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'staff' ? 'warning' : 'info') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $user->email ?? '-' }}<br>
                                    <small>{{ $user->phone ?? '-' }}</small>
                                </td>
                                <td class="text-muted small">{{ $user->created_at->diffForHumans() }}</td>
                                <td class="text-end">
                                    <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-info">Xem</a>
                                    <form action="{{ route('users.toggle-status', $user) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $user->status === 'active' ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                            {{ $user->status === 'active' ? 'Chặn' : 'Mở' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center py-5 text-muted">Không tìm thấy người dùng nào.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection