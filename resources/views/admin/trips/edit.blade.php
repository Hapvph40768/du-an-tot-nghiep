@extends('layout.admin')

@section('content-main')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h3 class="fw-bold mb-4 text-primary">Cập nhật lịch trình: #{{ $trip->id }}</h3>
                    <form action="{{ route('admin.trips.update', $trip->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Tuyến đường</label>
                                <select name="route_id" class="form-select rounded-3">
                                    @foreach ($routes as $route)
                                        <option value="{{ $route->id }}"
                                            {{ $trip->route_id == $route->id ? 'selected' : '' }}>
                                            {{ $route->departureLocation->name }} → {{ $route->destinationLocation->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Ngày khởi hành</label>
                                <input type="date" name="trip_date" class="form-control rounded-3"
                                    value="{{ $trip->trip_date }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Giờ xuất bến</label>
                                @php
                                    $depH = substr($trip->departure_time, 0, 2);
                                    $depM = substr($trip->departure_time, 3, 2) ?: '00';
                                @endphp
                                <div class="input-group">
                                    <select name="departure_hour" class="form-select rounded-start-3" style="max-width:80px;">
                                        <option value="">--</option>
                                        @for($h = 0; $h < 24; $h++)
                                        <option value="{{ str_pad($h,2,'0',STR_PAD_LEFT) }}"
                                            {{ $depH == str_pad($h,2,'0',STR_PAD_LEFT) ? 'selected' : '' }}>{{ str_pad($h,2,'0',STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                    <span class="input-group-text px-1">:</span>
                                    <select name="departure_minute" class="form-select rounded-end-3" style="max-width:80px;">
                                        @foreach(['00','15','30','45'] as $min)
                                        <option value="{{ $min }}" {{ $depM === $min ? 'selected' : '' }}>{{ $min }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Giờ đến dự kiến</label>
                                @php
                                    $arrH = substr($trip->arrival_time ?? '', 0, 2);
                                    $arrM = substr($trip->arrival_time ?? '', 3, 2) ?: '00';
                                @endphp
                                <div class="input-group">
                                    <select name="arrival_hour" class="form-select rounded-start-3" style="max-width:80px;">
                                        <option value="">--</option>
                                        @for($h = 0; $h < 24; $h++)
                                        <option value="{{ str_pad($h,2,'0',STR_PAD_LEFT) }}"
                                            {{ $arrH == str_pad($h,2,'0',STR_PAD_LEFT) ? 'selected' : '' }}>{{ str_pad($h,2,'0',STR_PAD_LEFT) }}</option>
                                        @endfor
                                    </select>
                                    <span class="input-group-text px-1">:</span>
                                    <select name="arrival_minute" class="form-select rounded-end-3" style="max-width:80px;">
                                        @foreach(['00','15','30','45'] as $min)
                                        <option value="{{ $min }}" {{ $arrM === $min ? 'selected' : '' }}>{{ $min }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Xe phụ trách</label>
                                <select name="vehicle_id" class="form-select rounded-3">
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}"
                                            {{ $trip->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->license_plate }} ({{ $vehicle->type }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tài xế phụ trách</label>
                                <select name="driver_id" class="form-select rounded-3">
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}"
                                            {{ $trip->driver_id == $driver->id ? 'selected' : '' }}>
                                            {{ $driver->name }} (SĐT: {{ $driver->phone }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('driver_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Trạng thái chuyến đi</label>
                                <select name="status" class="form-select rounded-3 fw-bold text-primary">
                                    <option value="active" {{ $trip->status == 'active' ? 'selected' : '' }}>Đang mở bán
                                    </option>
                                    <option value="completed" {{ $trip->status == 'completed' ? 'selected' : '' }}>Đã hoàn
                                        thành</option>
                                    <option value="cancelled" {{ $trip->status == 'cancelled' ? 'selected' : '' }}>Hủy
                                        chuyến</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Điều chỉnh Giá vé</label>
                                <input type="number" name="price" class="form-control rounded-3"
                                    value="{{ $trip->price }}">
                            </div>

                            {{-- Điểm đón khách --}}
                            <div class="col-md-6 mt-4">
                                <label class="form-label fw-bold">Điểm đón khách (Chọn theo tuyến đường)</label>
                                <select name="pickup_points[]" id="pickup_points" class="form-select rounded-3" multiple style="height: 120px;">
                                    <!-- Options will be populated by JS -->
                                </select>
                            </div>

                            {{-- Điểm trả khách --}}
                            <div class="col-md-6 mt-4">
                                <label class="form-label fw-bold">Điểm trả khách (Chọn theo tuyến đường)</label>
                                <select name="dropoff_points[]" id="dropoff_points" class="form-select rounded-3" multiple style="height: 120px;">
                                    <!-- Options will be populated by JS -->
                                </select>
                            </div>
                        </div>
                        <div class="mt-5 pt-3 border-top">
                            <button type="submit" class="btn btn-success px-5 py-2 fw-bold"
                                style="border-radius: 10px;">Lưu cập nhật</button>
                            <a href="{{ route('admin.trips.index') }}" class="btn btn-light px-4 border ms-2"
                                style="border-radius: 10px;">Quay lại</a>
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

        const selectedPickups = @json($trip->pickupPoints->pluck('id')->toArray());
        const selectedDropoffs = @json($trip->dropoffPoints->pluck('id')->toArray());

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
                            if (selectedPickups.includes(point.id)) {
                                option.selected = true;
                            }
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
                            if (selectedDropoffs.includes(point.id)) {
                                option.selected = true;
                            }
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

        // Fetch on load if route is already selected
        if (routeSelect.value) {
            fetchPoints(routeSelect.value);
        }
    });
</script>
@endpush
