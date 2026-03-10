@extends('layout.admin.AdminLayout')

@section('content-main')
<h3>Thêm xe</h3>

<form action="{{ route('vehicles.store') }}" method="POST" class="w-50">
    @csrf

    <div class="mb-3">
        <label>Biển số</label>
        <input type="text" name="license_plate" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Loại xe</label>
        <input type="text" name="type" class="form-control">
    </div>

    <div class="mb-3">
        <label>Số ghế</label>
        <input type="number" name="total_seats" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-select">
            <option value="active">Hoạt động</option>
            <option value="maintenance">Bảo trì</option>
        </select>
    </div>

    <button class="btn btn-success">Lưu</button>
    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
