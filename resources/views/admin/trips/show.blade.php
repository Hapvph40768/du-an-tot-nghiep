@extends('layout.admin')

@section('title', 'Chi tiết chuyến xe #' . $trip->id)

@section('content-main')
<style>
    :root { --primary-color: #ff6b00; --secondary-bg: #f8fafc; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; height: 100%; }
    .label-custom { font-size: 11px; text-transform: uppercase; font-weight: 700; color: #94a3b8; letter-spacing: 0.5px; }
    .value-custom { font-size: 16px; font-weight: 700; color: #1e293b; display: block; margin-top: 4px; }
    
    /* Lộ trình dừng */
    .timeline-item { position: relative; padding-left: 30px; padding-bottom: 20px; border-left: 2px dashed #e2e8f0; }
    .timeline-item:last-child { border-left: none; padding-bottom: 0; }
    .timeline-item::before { content: ''; position: absolute; left: -7px; top: 0; width: 12px; height: 12px; background: var(--primary-color); border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px #ff6b0033; }
    
    .capacity-box { background: #f1f5f9; padding: 20px; border-radius: 12px; text-align: center; }
    .capacity-number { font-size: 2.5rem; font-weight: 800; color: #ff6b00; }
    .capacity-label { font-size: 13px; font-weight: 600; color: #64748b; text-transform: uppercase; margin-top: 5px; }
    .capacity-stats { display: flex; justify-content: space-around; margin-top: 15px; border-top: 1px dashed #cbd5e1; padding-top: 15px; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <a href="{{ route('admin.trips.index') }}" class="text-decoration-none text-muted small fw-bold">
                <i class='bx bx-left-arrow-alt'></i> QUAY LẠI DANH SÁCH
            </a>
            <h2 class="fw-bold text-dark m-0 mt-2">
                {{ $trip->route->departureLocation->name }} 
                <i class='bx bx-right-arrow-alt text-primary'></i> 
                {{ $trip->route->destinationLocation->name }}
            </h2>
            <div class="mt-1">
                <span class="badge bg-primary rounded-pill">Mã chuyến: #TRIP-{{ $trip->id }}</span>
                <span class="badge bg-light text-dark border rounded-pill ms-1">{{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }}</span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-light border px-4 rounded-3"><i class='bx bx-edit'></i> Chỉnh sửa thông tin</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-box">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Vận hành & Tài chính</h5>
                <div class="row g-4">
                    <div class="col-6">
                        <span class="label-custom">Giờ xuất bến</span>
                        <span class="value-custom text-primary fs-4">{{ $trip->departure_time }}</span>
                    </div>
                    <div class="col-6">
                        <span class="label-custom">Giờ đến dự kiến</span>
                        <span class="value-custom">{{ $trip->arrival_time }}</span>
                    </div>
                    <div class="col-12">
                        <span class="label-custom">Giá vé niêm yết</span>
                        <span class="value-custom text-danger fs-5">{{ number_format($trip->price) }} VNĐ</span>
                    </div>
                    <div class="col-12">
                        <div class="p-3 bg-light rounded-3">
                            <span class="label-custom">Phương tiện</span>
                            <span class="value-custom">{{ $trip->vehicle->license_plate }} ({{ $trip->vehicle->type }})</span>
                            <hr class="my-2">
                            <span class="label-custom">Tài xế phụ trách</span>
                            <span class="value-custom">{{ $trip->driver->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box" style="overflow-y: auto; max-height: 600px;">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h5 class="fw-bold m-0">Điểm đón khách</h5>
                    <a href="{{ route('admin.trips.pickup_points.index', $trip->id) }}" class="btn btn-sm btn-light border"><i class='bx bx-edit'></i></a>
                </div>
                <div class="ps-2 mt-3 mb-5">
                    @forelse($trip->pickupPoints as $point)
                        <div class="timeline-item">
                            <div class="fw-bold text-dark">{{ $point->name }}</div>
                            <div class="text-muted small">{{ $point->address }}</div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class='bx bx-map-alt fs-2 text-muted opacity-25'></i>
                            <p class="text-muted small mt-2">Chưa thiết lập điểm đón.</p>
                            <a href="{{ route('admin.trips.pickup_points.index', $trip->id) }}" class="btn btn-sm btn-outline-primary mt-2">Thiết lập ngay</a>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2 mt-4">
                    <h5 class="fw-bold m-0">Điểm trả khách</h5>
                    <a href="{{ route('admin.trips.dropoff_points.index', $trip->id) }}" class="btn btn-sm btn-light border"><i class='bx bx-edit'></i></a>
                </div>
                <div class="ps-2 mt-3">
                    @forelse($trip->dropoffPoints as $point)
                        <div class="timeline-item" style="--primary-color: #3b82f6;">
                            <div class="fw-bold text-dark">{{ $point->name }}</div>
                            <div class="text-muted small">{{ $point->address }}</div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class='bx bx-map-alt fs-2 text-muted opacity-25'></i>
                            <p class="text-muted small mt-2">Chưa thiết lập điểm trả.</p>
                            <a href="{{ route('admin.trips.dropoff_points.index', $trip->id) }}" class="btn btn-sm btn-outline-primary mt-2">Thiết lập ngay</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h5 class="fw-bold m-0">Tình trạng đặt vé</h5>
                    <span class="badge bg-success small">Đang mở bán</span>
                </div>
                
                <div class="capacity-box text-center">
                    <div class="capacity-number">{{ $availableSeats }}</div>
                    <div class="capacity-label">Chỗ còn trống</div>
                    
                    <div class="capacity-stats">
                        <div>
                            <span class="d-block fw-bold text-dark fs-5">{{ $totalSeats }}</span>
                            <span class="text-muted small">Tổng ghế</span>
                        </div>
                        <div>
                            <span class="d-block fw-bold text-danger fs-5">{{ $bookedSeats }}</span>
                            <span class="text-muted small">Đã đặt</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('admin.tickets.index', ['trip_id' => $trip->id]) }}" class="btn btn-primary w-100 py-2 fw-bold" style="background: var(--primary-color); border-color: var(--primary-color);">
                        <i class='bx bx-list-ol mr-1'></i> Xem danh sách vé
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
