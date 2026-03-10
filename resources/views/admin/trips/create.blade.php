@extends('layout.admin.AdminLayout')

@section('content-main')

<div class="container mt-5">

    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-gradient bg-primary text-white rounded-top-4">
            <h4 class="mb-0">
                <i class="bi bi-bus-front"></i> Thêm Trip
            </h4>
        </div>

        <div class="card-body p-4">

            <a href="{{ route('admin.trips.index') }}"
                class="btn btn-outline-secondary mb-4">
                <i class="bi bi-arrow-left"></i> Quay lại danh sách
            </a>

            @if ($errors->any())
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.trips.store') }}" method="POST">
                @csrf

                <div class="row g-4">

                    {{-- Tuyến --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-signpost-2"></i> Tuyến xe
                        </label>
                        <select name="route_id" class="form-select shadow-sm" required>
                            <option value="">-- Chọn tuyến --</option>
                            @foreach($routes as $route)
                            <option value="{{ $route->id }}">
                                {{ $route->startLocation->name ?? '' }}
                                →
                                {{ $route->endLocation->name ?? '' }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Ngày --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-calendar-date"></i> Ngày
                        </label>
                        <input type="date"
                            name="trip_date"
                            class="form-control shadow-sm"
                            required>
                    </div>

                    {{-- Giờ --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-clock"></i> Giờ khởi hành
                        </label>
                        <input type="datetime-local" name="departure_time" class="form-control">
                    </div>

                    {{-- Xe --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-truck"></i> Xe
                        </label>
                        <select name="vehicle_id" class="form-select shadow-sm" required>
                            <option value="">-- Chọn xe --</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">
                                {{ $vehicle->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tài xế --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-person-badge"></i> Tài xế
                        </label>
                        <select name="driver_id" class="form-select shadow-sm" required>
                            <option value="">-- Chọn tài xế --</option>
                            @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}">
                                {{ $driver->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Giá --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-cash-stack"></i> Giá vé (VNĐ)
                        </label>
                        <input type="text"
                            id="price"
                            name="price"
                            class="form-control shadow-sm"
                            placeholder="Nhập giá vé"
                            required>
                    </div>

                </div>

                <div class="text-end mt-4">
                    <button type="submit"
                        class="btn btn-lg text-white px-4"
                        style="background: linear-gradient(45deg,#28a745,#20c997); border:none;">
                        <i class="bi bi-save"></i> Lưu Trip
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- Format tiền VNĐ --}}
<script>
    document.getElementById('price').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = new Intl.NumberFormat('vi-VN').format(value);
    });
</script>

@endsection