@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Đội xe')

@section('content-main')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h5 class="text-muted mb-1 small text-uppercase fw-bold">Quản trị viên</h5>
            <h2 class="fw-bold text-dark m-0">Danh sách Đội xe</h2>
        </div>

        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">
                        Trang chủ
                    </a>
                </li>
                <li class="breadcrumb-item active text-primary">
                    Đội xe
                </li>
            </ol>
        </nav>
    </div>

    <div class="card shadow-sm p-4">

        {{-- thông báo --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">

            {{-- search --}}
            <form action="{{ route('admin.vehicles.index') }}" method="GET" class="d-flex gap-2">
                <input type="text"
                       name="keyword"
                       value="{{ request('keyword') }}"
                       class="form-control"
                       placeholder="Tìm biển số, loại xe...">

                <select name="status" class="form-select">
                    <option value="">Tất cả trạng thái</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                        Hoạt động
                    </option>
                    <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>
                        Bảo dưỡng
                    </option>
                </select>

                <button class="btn btn-primary">Lọc</button>
            </form>

            {{-- thêm --}}
            <a href="{{ route('admin.vehicles.create') }}" class="btn btn-success">
                + Thêm Xe
            </a>

        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">

                <thead class="table-light">
                    <tr>
                        <th>Biển số</th>
                        <th>Loại xe</th>
                        <th>Số ghế</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th width="120">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($vehicles as $vehicle)
                        <tr>

                            <td>{{ $vehicle->license_plate }}</td>

                            <td>{{ $vehicle->type ?? 'Chưa xác định' }}</td>

                            <td>{{ $vehicle->total_seats }}</td>

                            <td>
                                @if ($vehicle->status == 'active')
                                    <span class="badge bg-success">Hoạt động</span>
                                @else
                                    <span class="badge bg-warning text-dark">Bảo dưỡng</span>
                                @endif
                            </td>

                            <td>
                                {{ $vehicle->created_at ? \Carbon\Carbon::parse($vehicle->created_at)->format('d/m/Y') : 'N/A' }}
                            </td>

                            <td>

                                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Sửa
                                </a>

                                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        Xóa
                                    </button>

                                </form>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Không có dữ liệu
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- <div class="mt-3">
            {{ $vehicles->links() }}
        </div> --}}

    </div>
</div>

@endsection