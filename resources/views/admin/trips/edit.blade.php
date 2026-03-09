@extends('layout.admin.AdminLayout')

@section('title', 'Sửa Chuyến Xe')
@section('header-title', 'QUẢN LÝ CHUYẾN XE')

@section('content-main')
<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-dark py-3">
            <h5 class="mb-0 fw-bold">Cập Nhật Chuyến Xe #{{ $trip->id }}</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('trips.update', $trip->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Điểm đi <span class="text-danger">*</span></label>
                        <input type="text" name="departure_location" class="form-control" value="{{ old('departure_location', $trip->departure_location) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Điểm đến <span class="text-danger">*</span></label>
                        <input type="text" name="destination_location" class="form-control" value="{{ old('destination_location', $trip->destination_location) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Ngày khởi hành <span class="text-danger">*</span></label>
                        <input type="date" name="departure_date" class="form-control" value="{{ old('departure_date', $trip->departure_date) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Giờ khởi hành <span class="text-danger">*</span></label>
                        <input type="time" name="departure_time" class="form-control" value="{{ old('departure_time', \Carbon\Carbon::parse($trip->departure_time)->format('H:i')) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Giá vé (VNĐ) <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', (int)$trip->price) }}" required min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tài xế phụ trách</label>
                        <select name="driver_id" class="form-select">
                            <option value="">-- Chưa xếp tài xế --</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id', $trip->driver_id) == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->name }} (Bằng lái: {{ $driver->license_number }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="pending" {{ old('status', $trip->status) == 'pending' ? 'selected' : '' }}>Chờ chạy</option>
                            <option value="running" {{ old('status', $trip->status) == 'running' ? 'selected' : '' }}>Đang chạy</option>
                            <option value="completed" {{ old('status', $trip->status) == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="cancelled" {{ old('status', $trip->status) == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 text-end">
                    <a href="{{ route('trips.index') }}" class="btn btn-light border px-4 me-2">Quay lại</a>
                    <button type="submit" class="btn btn-warning px-4 text-dark fw-bold">Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection