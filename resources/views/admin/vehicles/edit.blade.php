@extends('layout.admin.AdminLayout')

@section('content-main')
<h3>Cập nhật xe</h3>

<form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" class="w-50">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Biển số</label>
        <input type="text" name="license_plate" value="{{ $vehicle->license_plate }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Loại xe</label>
        <input type="text" name="type" value="{{ $vehicle->type }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Số ghế</label>
        <input type="number" name="total_seats" value="{{ $vehicle->total_seats }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-select">
            <option value="active" {{ $vehicle->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
            <option value="maintenance" {{ $vehicle->status == 'maintenance' ? 'selected' : '' }}>Bảo trì</option>
        </select>
    </div>

    <button class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
