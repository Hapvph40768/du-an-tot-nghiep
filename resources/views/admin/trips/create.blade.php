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
                                <label class="form-label fw-bold small text-muted">Giờ xuất bến</label>
                                @php
                                    $depOld = old('departure_time', '');
                                    $depH = $depOld ? (int)substr($depOld, 0, 2) : '';
                                    $depM = $depOld ? substr($depOld, 3, 2) : '00';
                                @endphp
                                <div class="input-group">
                                    <select name="departure_hour" class="form-select rounded-start-3 @error('departure_time') is-invalid @enderror" style="max-width:80px;">
                                        <option value="">--</option>
                                        @for($h = 0; $h < 24; $h++)
                                        <option value="{{ str_pad($h,2,'0',STR_PAD_LEFT) }}" {{ $depH === $h ? 'selected' : '' }}>{{ str_pad($h,2,'0',STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                    <span class="input-group-text px-1">:</span>
                                    <select name="departure_minute" class="form-select rounded-end-3" style="max-width:80px;">
                                        @foreach(['00','15','30','45'] as $min)
                                        <option value="{{ $min }}" {{ $depM === $min ? 'selected' : '' }}>{{ $min }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('departure_time')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            {{-- Giờ đến dự kiến --}}<div class="col-md-3">
                                <label class="form-label fw-bold small text-muted">Giờ đến dự kiến</label>
                                @php
                                    $arrOld = old('arrival_time', '');
                                    $arrH = $arrOld ? (int)substr($arrOld, 0, 2) : '';
                                    $arrM = $arrOld ? substr($arrOld, 3, 2) : '00';
                                @endphp
                                <div class="input-group">
                                    <select name="arrival_hour" class="form-select rounded-start-3 @error('arrival_time') is-invalid @enderror" style="max-width:80px;">
                                        <option value="">--</option>
                                        @for($h = 0; $h < 24; $h++)
                                        <option value="{{ str_pad($h,2,'0',STR_PAD_LEFT) }}" {{ $arrH === $h ? 'selected' : '' }}>{{ str_pad($h,2,'0',STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                    <span class="input-group-text px-1">:</span>
                                    <select name="arrival_minute" class="form-select rounded-end-3" style="max-width:80px;">
                                        @foreach(['00','15','30','45'] as $min)
                                        <option value="{{ $min }}" {{ $arrM === $min ? 'selected' : '' }}>{{ $min }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('arrival_time')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
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

                            {{-- Điểm đón khách --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Điểm đón khách (Chọn theo tuyến đường)</label>
                                <select name="pickup_points[]" id="pickup_points" class="form-select rounded-3" multiple style="height: 120px;">
                                    <!-- Options will be populated by JS -->
                                </select>
                            </div>

                            {{-- Điểm trả khách --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Điểm trả khách (Chọn theo tuyến đường)</label>
                                <select name="dropoff_points[]" id="dropoff_points" class="form-select rounded-3" multiple style="height: 120px;">
                                    <!-- Options will be populated by JS -->
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const routeSelect = document.querySelector('select[name="route_id"]');
        const pickupSelect = document.getElementById('pickup_points');
        const dropoffSelect = document.getElementById('dropoff_points');

        function fetchPoints(routeId) {
            if (!routeId) {
                pickupSelect.innerHTML = '';
                dropoffSelect.innerHTML = '';
                return;
            }

            fetch(`/admin/trips/get-points/${routeId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate Pickup Points
                    pickupSelect.innerHTML = '';
                    if (data.pickup_points.length === 0) {
                        pickupSelect.innerHTML = '<option disabled>Không có điểm đón nào</option>';
                    } else {
                        data.pickup_points.forEach(point => {
                            const option = document.createElement('option');
                            option.value = point.id;
                            option.textContent = point.name + (point.address ? ' (' + point.address + ')' : '');
                            pickupSelect.appendChild(option);
                        });
                    }

                    // Populate Dropoff Points
                    dropoffSelect.innerHTML = '';
                    if (data.dropoff_points.length === 0) {
                        dropoffSelect.innerHTML = '<option disabled>Không có điểm trả nào</option>';
                    } else {
                        data.dropoff_points.forEach(point => {
                            const option = document.createElement('option');
                            option.value = point.id;
                            option.textContent = point.name + (point.address ? ' (' + point.address + ')' : '');
                            dropoffSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error fetching points:', error));
        }

        // Fetch on change
        routeSelect.addEventListener('change', function () {
            fetchPoints(this.value);
        });

        // Fetch on load if route is already selected (e.g. old input)
        if (routeSelect.value) {
            fetchPoints(routeSelect.value);
        }
    });
</script>
@endpush
