@extends('layout.admin.AdminLayout')

@section('title', 'Hồ sơ tài xế: ' . $driver->name)

@section('content-main')
<style>
    :root { --primary-color: #ff6b00; }} .card-profile { background: #ffffff; border-radius: 16px; border: 1px solid #f0f0f0; box-shadow: 0 5px 20px rgba(0,0,0,0.03); overflow: hidden; }} .profile-header { background: linear-gradient(135deg, #ff6b00 0%, #ff9e00 100%); height: 100px; }} .profile-avatar { width: 100px; height: 100px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-top: -50px; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-left: auto; margin-right: auto; }} .info-label { font-size: 11px; text-transform: uppercase; font-weight: 700; color: #94a3b8; letter-spacing: 0.5px; margin-bottom: 4px; }} .info-value { font-size: 15px; font-weight: 600; color: #1e293b; }} .badge-status { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; }}</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <a href="{{ route('admin.drivers.index') }}" class="text-decoration-none text-muted small fw-bold">
                <i class='bx bx-left-arrow-alt'></i> DANH SÁCH TÀI XẾ
            </a>
            <h2 class="fw-bold text-dark m-0 mt-2">Thông tin tài xế</h2>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-light border px-4 rounded-3"><i class='bx bx-edit'></i> Chỉnh sửa</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-profile pb-4">
                <div class="profile-header"></div>
                <div class="profile-avatar">
                    <i class='bx bx-user' style="font-size: 50px; color: var(--primary-color);"></i>
                </div>
                <div class="text-center mt-3 px-3">
                    <h4 class="fw-bold m-0">{{ $driver->name }}}</h4>
                    <p class="text-muted small mb-3">{{{ __('drivers') }} chuyên nghiệp</p>
                    <span class="badge-status {{ $driver->status == 'active' ? 'bg-success text-white' : 'bg-secondary text-white' }}">
                        {{ $driver->status == 'active' ? 'ĐANG LÀM VIỆC' : 'TẠM NGHỈ' }}}</span>
                </div>
                <hr class="mx-4 my-4">
                <div class="px-4">
                    <div class="mb-3">
                        <div class="info-label">Số điện thoại</div>
                        <div class="info-value"><i class='bx bx-phone text-primary'></i> {{ $driver->phone ?? 'Chưa cập nhật' }}}</div>
                    </div>
                    <div class="mb-3">
                        <div class="info-label">Số bằng lái</div>
                        <div class="info-value"><i class='bx bx-id-card text-primary'></i> {{ $driver->license_number ?? 'N/A' }}}</div>
                    </div>
                    <div class="mb-3">
                        <div class="info-label">Kinh nghiệm</div>
                        <div class="info-value"><i class='bx bx-time-five text-primary'></i> {{ $driver->experience_years }}} năm</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3 border-bottom pb-2">Ghi chú & Tiểu sử</h5>
                <p class="text-muted" style="line-height: 1.6;">
                    {{ $driver->personal_info ?: 'Không có thông tin bổ sung cho tài xế này.' }}}</p>
            </div>

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Các chuyến xe phụ trách gần đây</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="small fw-bold">CHUYẾN XE</th>
                                <th class="small fw-bold text-center">NGÀY CHẠY</th>
                                <th class="small fw-bold text-center">TRẠNG THÁI</th>
                                <th class="small fw-bold text-end">XEM</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($driver->trips as $trip)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">
                                            {{ $trip->route->departureLocation->name }}} → {{ $trip->route->destinationLocation->name }}}</div>
                                        <div class="small text-primary fw-bold">{{ $trip->departure_time }}}</div>
                                    </td>
                                    <td class="text-center small">{{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }}}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $trip->status == 'active' ? 'bg-light text-primary' : 'bg-light text-muted' }}} border small">
                                            {{ $trip->status == 'active' ? 'Sắp chạy' : 'Đã xong' }}}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.trips.show', $trip->id) }}" class="btn btn-sm btn-light border"><i class='bx bx-show'></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted small">{{{ __('drivers') }} này chưa được phân công chuyến nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection