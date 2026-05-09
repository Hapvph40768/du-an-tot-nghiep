@extends('layout.admin')

@section('header-title', 'Quản lý Đội xe')
@section('header-subtitle', 'Theo dõi và điều phối tài xế hệ thống')

@section('content-main')
<div class="container-fluid px-0">
    <!-- Header Actions -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <form action="{{ route('admin.drivers.index') }}" method="GET" class="d-flex gap-2 flex-grow-1" style="max-width: 600px;">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class='bx bx-search text-muted'></i></span>
                <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control border-start-0 ps-0" placeholder="Tìm tên, SĐT, bằng lái...">
            </div>
            <select name="status" class="form-select w-auto" onchange="this.form.submit()">
                <option value="">Tất cả trạng thái</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                <option value="busy" {{ request('status') == 'busy' ? 'selected' : '' }}>Đang chạy</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Đã nghỉ</option>
            </select>
        </form>

        <a href="{{ route('admin.drivers.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class='bx bx-plus-circle'></i>
            <span>Thêm Tài Xế</span>
        </a>
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
                        <th class="ps-4">Tài Xế</th>
                        <th>Liên Hệ</th>
                        <th>Bằng Lái</th>
                        <th>Trạng Thái</th>
                        <th class="text-end pe-4">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($drivers as $driver)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle overflow-hidden shadow-sm" style="width: 45px; height: 45px;">
                                    @if ($driver->image)
                                        <img src="{{ asset($driver->image) }}" class="w-100 h-100 object-fit-cover">
                                    @else
                                        <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-primary fw-bold fs-5">
                                            {{ substr($driver->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ $driver->name }}</h6>
                                    <small class="text-muted fw-bold">ID: #{{ $driver->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2 text-dark fw-bold mb-1">
                                <i class='bx bx-phone text-primary'></i>
                                <span>{{ $driver->phone }}</span>
                            </div>
                            <small class="text-muted">user{{ $driver->id }}@manhhung.vn</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border p-2">
                                <i class='bx bx-id-card text-muted me-1'></i> {{ $driver->license_number }}
                            </span>
                        </td>
                        <td>
                            @php
                                $statusConfig = [
                                    'active' => ['color' => 'success', 'label' => 'Sẵn sàng'],
                                    'busy' => ['color' => 'warning', 'label' => 'Đang chạy'],
                                    'inactive' => ['color' => 'danger', 'label' => 'Nghỉ lễ'],
                                ][$driver->status] ?? ['color' => 'secondary', 'label' => 'K.Xác định'];
                            @endphp
                            <span class="badge bg-{{ $statusConfig['color'] }} bg-opacity-10 text-{{ $statusConfig['color'] }}">
                                <i class='bx bxs-circle me-1' style="font-size: 8px;"></i> {{ $statusConfig['label'] }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.drivers.show', $driver->id) }}" class="btn btn-sm btn-light border text-info" title="Chi tiết">
                                    <i class='bx bx-show'></i>
                                </a>
                                <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-sm btn-light border text-primary" title="Chỉnh sửa">
                                    <i class='bx bx-edit-alt'></i>
                                </a>
                                <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" onsubmit="return confirm('Xác nhận xoá tài xế?');">
                                    @csrf
                                    @method('DELETE')
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

        @if($drivers->hasPages())
        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center p-4">
            <small class="text-muted fw-bold">Hiển thị {{ $drivers->count() }} / {{ $drivers->total() }} tài xế</small>
            <div>
                {{ $drivers->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
