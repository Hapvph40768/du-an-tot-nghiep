@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Chuyến xe')

@section('content-main')
    <style>
        :root {
            --primary-color: #ff6b00;
            --primary-hover: #e65100;
        }} .card-box {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0f0f0;
        }} .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
        }} .custom-table thead th {
            background-color: #f9fafb;
            color: #6b7280;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            padding: 16px;
            border-bottom: 2px solid #edf2f7;
            text-align: left;
        }} .custom-table td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            line-height: 1.5;
        }} .badge-status {
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            display: inline-block;
        }} .status-active {
            background: #e1f5fe;
            color: #0288d1;
        }} .status-completed {
            background: #e8f5e9;
            color: #2e7d32;
        }} .status-cancelled {
            background: #ffebee;
            color: #c62828;
        }} .price-text {
            color: #ff6b00;
            font-weight: 800;
            font-size: 15px;
        }} .action-btns .btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: 0.2s;
            background: #fff;
            border: 1px solid #e2e8f0;
        }} .action-btns .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }} .pickup-count {
            font-size: 10px;
            background: #fff7ed;
            color: #c2410c;
            padding: 2px 6px;
            border-radius: 6px;
            border: 1px solid #ffedd5;
            font-weight: 600;
            margin-left: 5px;
        }} /* Style cho lộ trình đón mini */
        .route-info-mini {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px dashed #f1f5f9;
        }} .route-info-mini i {
            font-size: 14px;
            vertical-align: middle;
        }} .filter-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
        }} .form-filter .form-control,
        .form-filter .form-select {
            border-radius: 8px;
            font-size: 13px;
        }}</style>

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark m-0">{{{ __('schedules') }} Chuyến xe</h2>
                <p class="text-muted small mb-0">Quản lý lộ trình và điều phối vận hành thực tế</p>
            </div>
            <a href="{{ route('admin.trips.create') }}" class="btn btn-primary px-4 py-2"
                style="background: #ff6b00; border:none; border-radius: 10px; font-weight: 600;">
                <i class='bx bx-plus-circle'></i> Lên lịch chuyến mới
            </a>
        </div>

        {{-- Bộ lọc --}}}<div class="filter-section shadow-sm">
            <form action="{{ route('admin.trips.index') }}" method="GET" class="row g-3 form-filter">
                <div class="col-md-3">
                    <label class="small fw-bold text-muted">{{{ __('search') }}</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Biển số xe, tên tài xế...">
                </div>
                <div class="col-md-2">
                    <label class="small fw-bold text-muted">Từ ngày</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="small fw-bold text-muted">{{{ __('status') }}</label>
                    <select name="status" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang mở bán</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Đã hoàn thành
                        </option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-dark px-3 rounded-3"><i class='bx bx-filter-alt'></i> Lọc</button>
                    <a href="{{ route('admin.trips.index') }}" class="btn btn-outline-secondary px-3 rounded-3">{{{ __('delete') }} lọc</a>
                </div>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">
                <i class='bx bx-check-circle me-2'></i> {{ session('success') }}}</div>
        @endif

        <div class="card-box shadow-sm">
            <div class="table-responsive">
                <table class="custom-table w-100">
                    <thead>
                        <tr>
                            <th style="width: 28%;">{{{ __('routes') }} / Lịch trình</th>
                            <th style="width: 15%;">Thời gian</th>
                            <th style="width: 18%;">Xe & Tài xế</th>
                            <th style="width: 12%;">{{{ __('cost') }}</th>
                            <th style="width: 12%;">{{{ __('status') }}</th>
                            <th style="width: 15%; text-align: right;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trips as $trip)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 15px;">
                                        {{ $trip->route->departureLocation->name }}}<i
                                            class='bx bx-right-arrow-alt text-muted'></i>
                                        {{ $trip->route->destinationLocation->name }}}</div>
                                    <div class="d-flex align-items-center mt-1">
                                        <span class="text-muted small">
                                            <i class='bx bx-calendar'></i>
                                            @if ($trip->trip_date)
                                                {{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }}} @else
                                                <span class="text-warning fw-bold">Chưa xếp lịch</span>
                                            @endif
                                        </span>
                                        <span class="pickup-count" title="Số điểm đón">
                                            <i class='bx bx-map-pin'></i> {{ $trip->pickupPoints->count() }}} điểm
                                        </span>
                                    </div>

                                    {{-- Hiển thị lộ trình đón khách thực tế --}}}<div class="route-info-mini">
                                        <span class="text-truncate d-block"
                                            title="{{ $trip->pickupPoints->pluck('name')->implode(' → ') }}">
                                            <strong>Dừng:</strong>
                                            {{ $trip->pickupPoints->pluck('name')->implode(' → ') ?: 'Chưa thiết lập' }}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-primary" style="font-size: 15px;">{{ $trip->departure_time }}}</div>
                                    <div class="text-muted small mt-1">Đến dự kiến: {{ $trip->arrival_time }}}</div>
                                </td>
                                <td>
                                    <div class="fw-bold" style="font-size: 13px;"><i class='bx bx-bus text-muted'></i>
                                        {{ $trip->vehicle->license_plate }}}</div>
                                    <div class="text-muted small mt-1"><i class='bx bx-user-pin text-muted'></i>
                                        {{ $trip->driver->name }}}</div>
                                </td>
                                <td><span class="price-text">{{ number_format($trip->price) }}đ</span></td>
                                <td>
                                    <span class="badge-status status-{{ $trip->status }}">
                                        @if ($trip->status == 'active')
                                            Mở bán
                                        @elseif($trip->status == 'completed')
                                            Xong
                                        @else
                                            Hủy
                                        @endif
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2 action-btns">
                                        <a href="{{ route('admin.trips.show', $trip->id) }}" title="Chi tiết & Ghế">
                                            <i class='bx bx-show text-info'></i>
                                        </a>
                                        <a href="{{ route('admin.trips.pickup_points.index', $trip->id) }}"
                                            title="="{{{ __('pickup_points') }">
                                            <i class='bx bx-map-alt text-warning'></i>
                                        </a>
                                        <a href="{{ route('admin.trips.edit', $trip->id) }}" title="="{{{ __('edit') }">
                                            <i class='bx bx-edit text-primary'></i>
                                        </a>
                                        <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST"
                                            onsubmit="return confirm('Hủy chuyến xe này?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" title="="{{{ __('cancel') }">
                                                <i class='bx bx-trash text-danger'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">Không tìm thấy chuyến xe nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $trips->appends(request()->query())->links('pagination::bootstrap-5') }}}</div>
        </div>
    </div>
@endsection
