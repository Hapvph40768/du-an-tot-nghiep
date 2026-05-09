@extends('layout.admin')

@section('title', 'Lên lịch Chuyến xe mới')

@section('content-main')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                {{-- Điều hướng nhanh --}}<nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.trips.index') }}"
                                class="text-decoration-none">Danh sách chuyến</a></li>
                        <li class="breadcrumb-item active">Tạo chuyến mới</li>
                    </ol>
                </nav>

                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h3 class="fw-bold mb-4 text-dark"><i class='bx bx-calendar-plus text-primary'></i> Lên lịch Chuyến xe
                        mới</h3>

                    <form action="{{ route('admin.trips.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            {{-- Chọn Tuyến đường --}}<div class="col-md-12">
                                <label class="form-label fw-bold small text-muted">Chọn Tuyến đường <span
                                        class="text-danger">*</span></label>
                                <select name="route_id"
                                    class="form-select rounded-3 shadow-sm @error('route_id') is-invalid @enderror">
                                    <option value="">-- Chọn tuyến đường vận hành --</option>
                                    @foreach ($routes as $route)
                                        <option value="{{ $route->id }}"
                                            {{ old('route_id') == $route->id ? 'selected' : '' }}>
                                            {{ $route->departureLocation->name }} → {{ $route->destinationLocation->name }} ({{ $route->distance_km }}km)
                                        </option>
                                    @endforeach
                                </select>
                                @error('route_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Ngày khởi hành --}}<div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">{{ __('date') }} khởi hành (Không bắt buộc)</label>
                                <input type="date" name="trip_date" value="{{ old('trip_date') }}"
                                    class="form-control rounded-3 @error('trip_date') is-invalid @enderror">
                                @error('trip_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Giờ xuất bến --}}<div class="col-md-3">
                                <label class="form-label fw-bold small text-muted">{{ __('time') }} xuất bến</label>
                                <input type="time" name="departure_time" value="{{ old('departure_time') }}"
                                    class="form-control rounded-3 @error('departure_time') is-invalid @enderror">
                                @error('departure_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Giờ đến dự kiến --}}<div class="col-md-3">
                                <label class="form-label fw-bold small text-muted">{{ __('time') }} đến dự kiến</label>
                                <input type="time" name="arrival_time" value="{{ old('arrival_time') }}"
                                    class="form-control rounded-3 @error('arrival_time') is-invalid @enderror">
                                @error('arrival_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Chọn Xe --}}<div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Chọn Xe vận hành <span
                                        class="text-danger">*</span></label>
                                <select name="vehicle_id"
                                    class="form-select rounded-3 @error('vehicle_id') is-invalid @enderror">
                                    <option value="">-- Chọn xe --</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}"
                                            {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->license_plate }} - {{ $vehicle->type }} ({{ $vehicle->total_seats }} ghế)
                                        </option>
                                    @endforeach
                                </select>
                                @error('vehicle_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tài xế --}}<div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">{{ __('drivers') }} phụ trách <span
                                        class="text-danger">*</span></label>
                                <select name="driver_id"
                                    class="form-select rounded-3 @error('driver_id') is-invalid @enderror">
                                    <option value="">-- Chọn tài xế --</option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}"
                                            {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                            {{ $driver->name }} (SĐT: {{ $driver->phone }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('driver_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Giá vé --}}<div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">{{ __('cost') }} niêm yết (VNĐ) <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="price" value="{{ old('price') }}"
                                        class="form-control rounded-3 @error('price') is-invalid @enderror"
                                        placeholder="Ví dụ: 250000">
                                    <span class="input-group-text">đ</span>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Trạng thái --}}<div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">{{ __('status') }} ban đầu</label>
                                <select name="status" class="form-select rounded-3">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Mở bán
                                        (Active)</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Tạm
                                        dừng/Hủy</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-5 pt-3 border-top d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-5 py-2 fw-bold"
                                style="background: #ff6b00; border:none; border-radius: 10px;">
                                <i class='bx bx-check-double'></i> Xác nhận tạo chuyến
                            </button>
                            <a href="{{ route('admin.trips.index') }}" class="btn btn-light px-4 border"
                                style="border-radius: 10px;">
                                Hủy bỏ
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
