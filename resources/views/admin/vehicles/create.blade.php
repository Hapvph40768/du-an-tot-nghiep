@extends('layout.admin.AdminLayout')

@section('title', 'Thêm xe mới')

@section('content-main')
<div class="container py-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Thêm xe mới</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Có lỗi xảy ra:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.vehicles.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Biển số xe <span class="text-danger">*</span></label>
                        <input type="text" name="license_plate" class="form-control"
                            value="{{ old('license_plate') }}" placeholder="Ví dụ: 29A-12345" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Loại xe</label>
                        <input type="text" name="type" class="form-control"
                            value="{{ old('type') }}" placeholder="Ví dụ: Xe 16 chỗ, Limousine...">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Số chỗ ngồi <span class="text-danger">*</span></label>
                        <input type="number" name="total_seats" class="form-control"
                            value="{{ old('total_seats', 16) }}" min="2" max="100" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                Hoạt động
                            </option>
                            <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>
                                Bảo dưỡng
                            </option>
                        </select>
                    </div>

                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">
                        Quay lại danh sách
                    </a>

                    <button type="submit" class="btn btn-success">
                        Thêm xe
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection