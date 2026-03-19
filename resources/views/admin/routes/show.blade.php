@extends('layout.admin.AdminLayout')

@section('title', 'Chi tiết Tuyến đường #' . $route->id)

@section('content-main')
<style>
    :root { --primary-color: #ff6b00; --primary-hover: #e65100; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; }
    .route-path { display: flex; align-items: center; gap: 20px; margin-bottom: 30px; padding: 20px; background: #fff8f3; border-radius: 12px; border: 1px solid #ffe8d6; }
    .location-box { text-align: center; flex: 1; }
    .location-name { font-size: 18px; font-weight: 700; color: #111827; margin-top: 8px; }
    .info-label { color: #6b7280; font-size: 13px; font-weight: 500; margin-bottom: 5px; }
    .info-value { color: #111827; font-weight: 700; font-size: 16px; }
    .arrow-icon { font-size: 32px; color: var(--primary-color); }
</style>

<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.routes.index') }}" class="text-decoration-none text-muted small fw-bold">
            <i class='bx bx-left-arrow-alt'></i> QUAY LẠI DANH SÁCH
        </a>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <h2 class="fw-bold text-dark m-0">Chi tiết tuyến đường</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.routes.edit', $route->id) }}" class="btn btn-outline-primary rounded-3 px-3">
                    <i class='bx bx-edit'></i> Chỉnh sửa
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card-box mb-4">
                <h5 class="fw-bold mb-4">Lộ trình di chuyển</h5>
                
                {{-- Sơ đồ điểm đi - điểm đến --}}
                <div class="route-path">
                    <div class="location-box">
                        <i class='bx bxs-map text-danger fs-2'></i>
                        <div class="small text-muted text-uppercase">Điểm khởi hành</div>
                        <div class="location-name">{{ $route->departureLocation->name }}</div>
                    </div>
                    
                    <div class="arrow-icon">
                        <i class='bx bx-right-arrow-alt'></i>
                    </div>

                    <div class="location-box">
                        <i class='bx bxs-map-pin text-success fs-2'></i>
                        <div class="small text-muted text-uppercase">Điểm kết thúc</div>
                        <div class="location-name">{{ $route->destinationLocation->name }}</div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 border-end">
                        <div class="info-label"><i class='bx bx-navigation'></i> Khoảng cách quãng đường</div>
                        <div class="info-value text-primary fs-4">{{ $route->distance }} <span class="small fw-normal text-muted">km</span></div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label"><i class='bx bx-time-five'></i> Thời gian hành trình dự kiến</div>
                        <div class="info-value text-primary fs-4">{{ $route->duration }} <span class="small fw-normal text-muted">giờ</span></div>
                    </div>
                </div>
            </div>

            <div class="card-box">
                <h5 class="fw-bold mb-3">Thông tin hệ thống</h5>
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="info-label">Mã ID hệ thống</div>
                        <div class="fw-bold">#{{ $route->id }}</div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="info-label">Ngày khởi tạo</div>
                        <div class="fw-bold text-muted small">{{ $route->created_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cột bên phải (Dùng để hiển thị thống kê hoặc lịch trình chuyến đi sau này) --}}
        <div class="col-md-4">
            <div class="card-box bg-light border-0">
                <h6 class="fw-bold text-dark mb-3">Ghi chú vận hành</h6>
                <p class="small text-muted mb-0">
                    Tuyến đường này hiện đang hoạt động bình thường. Mọi thay đổi về điểm đi/đến sẽ ảnh hưởng đến các Chuyến đi (Trips) đang sử dụng tuyến đường này.
                </p>
                <hr>
                <div class="d-grid">
                    <button class="btn btn-sm btn-white border text-primary fw-bold rounded-3">
                        <i class='bx bx-printer'></i> In báo cáo tuyến
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection