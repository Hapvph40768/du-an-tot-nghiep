@extends('layout.admin.AdminLayout')

@section('content-main')



<div class="container">
    <h2>🚌 Sửa Trip</h2>

    <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary mb-3">
        ← Quay lại danh sách
    </a>

    <form action="{{ route('admin.trips.update', $trip->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Tuyến xe --}}
        <div class="mb-3">
            <label class="form-label">Tuyến xe</label>
            <select name="route_id" class="form-control" required>
                @foreach($routes as $route)
                <option value="{{ $route->id }}"
                    {{ $trip->route_id == $route->id ? 'selected' : '' }}>
                    {{ $route->startLocation->name }} → {{ $route->endLocation->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Ngày --}}
        <div class="mb-3">
            <label class="form-label">Ngày</label>
            <input type="date"
                name="departure_date"
                class="form-control"
                value="{{ \Carbon\Carbon::parse($trip->departure_time)->format('Y-m-d') }}"
                required>
        </div>

        {{-- Giờ --}}
        <div class="mb-3">
            <label class="form-label">Giờ khởi hành</label>
            <input type="time"
                name="departure_time"
                class="form-control"
                value="{{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}"
                required>
        </div>

        {{-- Xe --}}
        <div class="mb-3">
            <label class="form-label">Xe</label>
            <select name="vehicle_id" class="form-control" required>
                @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}"
                    {{ $trip->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                    {{ $vehicle->name ?? 'Xe '.$vehicle->id }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Tài xế --}}
        <div class="mb-3">
            <label class="form-label">Tài xế</label>
            <select name="driver_id" class="form-control" required>
                @foreach($drivers as $driver)
                <option value="{{ $driver->id }}"
                    {{ $trip->driver_id == $driver->id ? 'selected' : '' }}>
                    {{ $driver->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Giá vé --}}
        <div class="mb-3">
            <label class="form-label">Giá vé (VNĐ)</label>
            <input type="number"
                name="price"
                class="form-control"
                value="{{ $trip->price }}"
                min="0"

                required>
        </div>

        <button type="submit" class="btn btn-success">
            ✅ Cập nhật
        </button>
    </form>
</div>

@endsection