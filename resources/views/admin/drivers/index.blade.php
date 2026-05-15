@extends('layout.admin')
@section('title', 'Danh sách Tài xế')
@section('content-main')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold m-0">Quản lý Tài xế</h4>
                <p class="text-muted small mb-0">Tổng: {{ $drivers->total() }} tài xế</p>
            </div>
            <a href="{{ route('admin.drivers.create') }}" class="btn px-4 py-2 fw-bold text-white" style="background:#ff6b00; border-radius:10px;">
                <i class='bx bx-plus-circle'></i> Thêm tài xế
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3 small">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light small text-uppercase text-muted">
                    <tr>
                        <th>Tài xế</th>
                        <th>Số điện thoại</th>
                        <th>CCCD</th>
                        <th>Số bằng lái</th>
                        <th>Hạng</th>
                        <th>Hết hạn BLX</th>
                        <th>Kinh nghiệm</th>
                        <th>Trạng thái</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($drivers as $driver)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($driver->avatar)
                                    <img src="{{ Storage::url($driver->avatar) }}" class="rounded-circle" style="width:36px;height:36px;object-fit:cover;" alt="">
                                @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:36px;height:36px;">
                                        <i class='bx bxs-user text-muted'></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold small">{{ $driver->name }}</div>
                                    <div class="text-muted" style="font-size:11px;">{{ $driver->user->email ?? '—' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="small">{{ $driver->phone ?? '—' }}</td>
                        <td class="small">{{ $driver->id_card_number ?? '—' }}</td>
                        <td class="small font-monospace">{{ $driver->license_number ?? '—' }}</td>
                        <td>
                            @if($driver->license_class)
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $driver->license_class }}</span>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="small">
                            @if($driver->license_expiry_date)
                                @php $expired = \Carbon\Carbon::parse($driver->license_expiry_date)->isPast(); @endphp
                                <span class="{{ $expired ? 'text-danger fw-bold' : 'text-dark' }}">
                                    {{ \Carbon\Carbon::parse($driver->license_expiry_date)->format('d/m/Y') }}
                                </span>
                                @if($expired) <i class='bx bx-error text-danger' title="Đã hết hạn"></i> @endif
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="small">{{ $driver->experience_years }} năm</td>
                        <td>
                            <span class="badge rounded-pill {{ $driver->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $driver->status === 'active' ? 'Hoạt động' : 'Ngừng' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.drivers.show', $driver->id) }}" class="btn btn-sm btn-light border" title="Xem chi tiết"><i class='bx bx-show'></i></a>
                            <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-sm btn-light border text-primary" title="Sửa"><i class='bx bx-edit'></i></a>
                            <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xóa tài xế này?')"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">Chưa có tài xế nào.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $drivers->links() }}</div>
    </div>
</div>
@endsection
