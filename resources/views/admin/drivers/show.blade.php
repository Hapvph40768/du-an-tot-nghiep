@extends('layout.admin')
@section('title', 'Chi tiết Tài xế')
@section('content-main')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.drivers.index') }}" class="btn btn-light border rounded-3">
            <i class='bx bx-left-arrow-alt'></i>
        </a>
        <div class="flex-grow-1">
            <h4 class="fw-bold m-0">Hồ sơ Tài xế</h4>
        </div>
        <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-outline-primary rounded-3 px-4">
            <i class='bx bx-edit'></i> Chỉnh sửa
        </a>
    </div>

    <div class="row g-4">
        {{-- CỘT TRÁI: Thông tin cá nhân --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center mb-4">
                @if($driver->avatar)
                    <img src="{{ Storage::url($driver->avatar) }}" class="rounded-circle mx-auto mb-3" style="width:100px;height:100px;object-fit:cover;" alt="Avatar">
                @else
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle bg-light" style="width:100px;height:100px;">
                        <i class='bx bxs-user text-muted' style="font-size:48px;"></i>
                    </div>
                @endif
                <h5 class="fw-bold mb-1">{{ $driver->name }}</h5>
                <span class="badge {{ $driver->status === 'active' ? 'bg-success' : 'bg-secondary' }} px-3 py-2 rounded-pill">
                    {{ $driver->status === 'active' ? 'Đang hoạt động' : 'Ngừng hoạt động' }}
                </span>

                <hr class="my-3">

                <div class="text-start small">
                    <div class="mb-2 d-flex gap-2">
                        <i class='bx bx-cake text-muted'></i>
                        <span>{{ $driver->date_of_birth ? \Carbon\Carbon::parse($driver->date_of_birth)->format('d/m/Y') : '—' }}</span>
                    </div>
                    <div class="mb-2 d-flex gap-2">
                        <i class='bx bx-user text-muted'></i>
                        <span>{{ ['male'=>'Nam','female'=>'Nữ','other'=>'Khác'][$driver->gender] ?? '—' }}</span>
                    </div>
                    <div class="mb-2 d-flex gap-2">
                        <i class='bx bx-phone text-muted'></i>
                        <span>{{ $driver->phone ?? '—' }}</span>
                    </div>
                    <div class="mb-2 d-flex gap-2">
                        <i class='bx bx-envelope text-muted'></i>
                        <span>{{ $driver->user->email ?? '—' }}</span>
                    </div>
                    <div class="mb-2 d-flex gap-2">
                        <i class='bx bx-id-card text-muted'></i>
                        <span>{{ $driver->id_card_number ?? '—' }}</span>
                    </div>
                    <div class="d-flex gap-2">
                        <i class='bx bx-map text-muted'></i>
                        <span>{{ $driver->address ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- CỘT PHẢI: Thông tin bằng lái + chuyến xe --}}
        <div class="col-md-8">
            {{-- Bằng lái --}}
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h6 class="fw-bold text-uppercase text-muted small mb-3" style="border-left:4px solid #ff6b00; padding-left:10px;">Thông tin Bằng lái xe</h6>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Số bằng lái</p>
                        <p class="fw-bold">{{ $driver->license_number ?? '—' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Hạng bằng lái</p>
                        <p class="fw-bold">{{ $driver->license_class ?? '—' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Ngày cấp</p>
                        <p class="fw-bold">{{ $driver->license_issued_date ? \Carbon\Carbon::parse($driver->license_issued_date)->format('d/m/Y') : '—' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Ngày hết hạn</p>
                        @php
                            $expired = $driver->license_expiry_date && \Carbon\Carbon::parse($driver->license_expiry_date)->isPast();
                        @endphp
                        <p class="fw-bold {{ $expired ? 'text-danger' : '' }}">
                            {{ $driver->license_expiry_date ? \Carbon\Carbon::parse($driver->license_expiry_date)->format('d/m/Y') : '—' }}
                            @if($expired) <span class="badge bg-danger ms-1">Hết hạn</span> @endif
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Số năm kinh nghiệm</p>
                        <p class="fw-bold">{{ $driver->experience_years }} năm</p>
                    </div>
                    @if($driver->license_image)
                    <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Ảnh bằng lái</p>
                        <a href="{{ Storage::url($driver->license_image) }}" target="_blank">
                            <img src="{{ Storage::url($driver->license_image) }}" class="rounded-3 border" style="height:70px;" alt="Bằng lái">
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Chuyến xe --}}
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h6 class="fw-bold text-uppercase text-muted small mb-3" style="border-left:4px solid #ff6b00; padding-left:10px;">
                    Lịch sử chuyến xe ({{ $driver->trips->count() }} chuyến)
                </h6>
                @if($driver->trips->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm align-middle small">
                        <thead class="table-light"><tr>
                            <th>#</th><th>Tuyến</th><th>Ngày</th><th>Giờ</th><th>Trạng thái</th>
                        </tr></thead>
                        <tbody>
                            @foreach($driver->trips->take(10) as $trip)
                            <tr>
                                <td>{{ $trip->id }}</td>
                                <td>{{ $trip->route->startLocation->name ?? '?' }} → {{ $trip->route->endLocation->name ?? '?' }}</td>
                                <td>{{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }}</td>
                                <td>{{ substr($trip->departure_time, 0, 5) }}</td>
                                <td><span class="badge bg-{{ $trip->status === 'completed' ? 'success' : ($trip->status === 'active' ? 'primary' : 'secondary') }}">{{ $trip->status }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted small mb-0">Chưa có chuyến xe nào.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
