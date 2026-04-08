@extends('layout.admin.AdminLayout')

@section('title', 'Chỉnh sửa Tuyến đường')

@section('content-main')
<style>
    :root { --primary-color: #ff6b00; --primary-hover: #e65100; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03); border: 1px solid #f0f0f0; }
    .form-label { font-weight: 600; color: #374151; font-size: 14px; }
    .btn-primary-custom { background-color: var(--primary-color); border: none; color: white; padding: 10px 25px; border-radius: 10px; font-weight: 600; transition: 0.3s; }
    .btn-primary-custom:hover { background-color: var(--primary-hover); transform: translateY(-2px); color: white; }
    .input-group-text { border-radius: 0 10px 10px 0; border-left: none; }
    .form-control-custom { border-radius: 10px !important; }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4">
                <a href="{{ route('admin.routes.index') }}" class="text-decoration-none text-muted small fw-bold">
                    <i class='bx bx-left-arrow-alt'></i> QUAY LẠI DANH SÁCH
                </a>
                <h2 class="fw-bold text-dark m-0 mt-2">Chỉnh sửa Tuyến đường #{{ $route->id }}</h2>
            </div>

            <div class="card-box shadow-sm">
                {{-- Hiển thị thông báo lỗi tổng quát nếu có --}}
                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm mb-4">
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.routes.update', $route->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        {{-- Điểm khởi hành --}}
                        <div class="col-md-6">
                            <label class="form-label">Điểm khởi hành</label>
                            <select name="start_location_id" class="form-select rounded-3 @error('start_location_id') is-invalid @enderror">
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" {{ old('start_location_id', $route->start_location_id) == $loc->id ? 'selected' : '' }}>
                                        {{ $loc->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('start_location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Điểm kết thúc --}}
                        <div class="col-md-6">
                            <label class="form-label">Điểm kết thúc</label>
                            <select name="end_location_id" class="form-select rounded-3 @error('end_location_id') is-invalid @enderror">
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" {{ old('end_location_id', $route->end_location_id) == $loc->id ? 'selected' : '' }}>
                                        {{ $loc->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('end_location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Khoảng cách --}}
                        <div class="col-md-6">
                            <label class="form-label">Khoảng cách (km)</label>
                            <div class="input-group">
                                <input type="number" name="distance_km" value="{{ old('distance_km', $route->distance_km) }}" 
                                       class="form-control rounded-3 @error('distance_km') is-invalid @enderror" placeholder="Ví dụ: 350">
                                <span class="input-group-text bg-light text-muted">km</span>
                            </div>
                            @error('distance_km') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        {{-- Thời gian dự kiến --}}
                        <div class="col-md-6">
                            <label class="form-label">Thời gian dự kiến (giờ)</label>
                            <div class="input-group">
                                <input type="number" step="0.1" name="estimated_time" value="{{ old('estimated_time', $route->estimated_time) }}" 
                                       class="form-control rounded-3 @error('estimated_time') is-invalid @enderror" placeholder="Ví dụ: 6.5">
                                <span class="input-group-text bg-light text-muted">giờ</span>
                            </div>
                            @error('estimated_time') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-5 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-primary-custom px-4">
                            <i class='bx bx-save'></i> Lưu thay đổi
                        </button>
                        <a href="{{ route('admin.routes.index') }}" class="btn btn-light px-4 border" style="border-radius: 10px;">Hủy bỏ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection