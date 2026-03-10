@extends('layout.admin.AdminLayout')

@section('title', 'Chỉnh sửa xe')

@section('content-main')
    <div class="container py-4">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Chỉnh sửa xe: {{ $vehicle->license_plate }}</h4>
            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class='bx bx-check-circle me-1'></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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

                <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Biển số xe <span class="text-danger">*</span></label>
                            <input type="text" name="license_plate" class="form-control"
                                value="{{ old('license_plate', $vehicle->license_plate) }}" placeholder="Ví dụ: 29A-12345"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Loại xe</label>
                            <input type="text" name="type" class="form-control"
                                value="{{ old('type', $vehicle->type) }}" placeholder="Ví dụ: Xe 16 chỗ, Limousine...">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số chỗ ngồi <span class="text-danger">*</span></label>
                            <input type="number" name="total_seats" class="form-control"
                                value="{{ old('total_seats', $vehicle->total_seats) }}" min="2" max="100"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="active" {{ old('status', $vehicle->status) == 'active' ? 'selected' : '' }}>
                                    Hoạt động
                                </option>
                                <option value="maintenance"
                                    {{ old('status', $vehicle->status) == 'maintenance' ? 'selected' : '' }}>
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
                            Lưu thay đổi
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
