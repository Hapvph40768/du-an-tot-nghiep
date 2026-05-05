@extends('layout.admin.AdminLayout')
@section('title', 'Gán điểm đón cho chuyến xe')
@section('content-main')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.trips.index') }}" class="text-decoration-none text-muted small fw-bold"><i class='bx bx-left-arrow-alt'></i> QUAY LẠI LỊCH TRÌNH</a>
        <h2 class="fw-bold text-dark mt-2">Thiết lập lộ trình dừng đón</h2>
        <p class="text-muted">Chuyến: <span class="text-primary fw-bold">{{ $trip->route->departureLocation->name }} → {{ $trip->route->destinationLocation->name }}</span></p>
    </div>

    <form action="{{ route('admin.trips.pickup_points.store', $trip->id) }}" method="POST">
        @csrf
        <div class="row">
            {{-- Cột bên trái: Danh sách để chọn --}}<div class="col-md-7">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold m-0">Chọn từ danh mục hệ thống</h5>
                        <a href="{{ route('admin.pickup-points.create') }}" target="_blank" class="text-primary small text-decoration-none fw-bold">+ Tạo điểm mới vào kho</a>
                    </div>
                    
                    <div class="scroll-area" style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-hover">
                            <thead class="sticky-top bg-white">
                                <tr class="small text-muted">
                                    <th width="50">Chọn</th>
                                    <th>{{ __('name') }} điểm / Địa chỉ</th>
                                    <th>Tỉnh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allPickupPoints as $point)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="pickup_point_ids[]" value="{{ $point->id }}" 
                                               class="form-check-input" {{ $trip->pickupPoints->contains($point->id) ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $point->name }}</div>
                                        <div class="text-muted small">{{ $point->address }}</div>
                                    </td>
                                    <td><span class="badge bg-light text-dark">{{ $point->location->name }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Cột bên phải: Tóm tắt & Lưu --}}<div class="col-md-5">
                <div class="card shadow-sm border-0 rounded-4 p-4 sticky-top" style="top: 20px;">
                    <h5 class="fw-bold mb-3">{{ __('trajectory_mobile') }} hiện tại</h5>
                    <div class="bg-light p-3 rounded-3 mb-4">
                        @forelse($trip->pickupPoints as $index => $p)
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-primary me-2">{{ $index + 1 }}</span>
                                <span class="small fw-bold text-dark">{{ $p->name }}</span>
                            </div>
                        @empty
                            <p class="text-muted small m-0 italic">Chưa chọn điểm dừng nào.</p>
                        @endforelse
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="background: #ff6b00; border:none; border-radius: 10px;">
                        CẬP NHẬT LỘ TRÌNH
                    </button>
                    <p class="text-center text-muted small mt-3 italic"><i class='bx bx-info-circle'></i> Tick chọn ở bảng bên trái và nhấn Cập nhật để gán điểm đón.</p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection