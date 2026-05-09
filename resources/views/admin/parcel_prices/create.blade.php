@extends('layout.admin')

@section('header-title', 'THÊM GIÁ KÝ GỬI')
@section('header-subtitle', 'Cấu hình giá mới cho một tuyến và khoảng trọng lượng')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-start">
                                <i class='bx bx-error-circle me-2 mt-1'></i>
                                <div>
                                    <strong>Kiểm tra lại thông tin:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.parcel_prices.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="route_id" class="form-label fw-bold">Tuyến đường <span class="text-danger">*</span></label>
                            <select name="route_id" id="route_id" class="form-control form-control-lg @error('route_id') is-invalid @enderror" required>
                                <option value="">-- Chọn tuyến để bắt đầu --</option>
                                @foreach($routes as $route)
                                    <optgroup label="{{ $route->departureLocation->name ?? '...' }} → {{ $route->destinationLocation->name ?? '...' }}">
                                        <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                                            (ID: {{ $route->id }})
                                        </option>
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('route_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">Chọn tuyến mà bạn muốn cấu hình giá</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="weight_from" class="form-label fw-bold">Từ (kg) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0" name="weight_from" id="weight_from" 
                                        value="{{ old('weight_from') }}" required
                                        class="form-control form-control-lg @error('weight_from') is-invalid @enderror"
                                        placeholder="0.00">
                                    @error('weight_from')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-2">Khối lượng tối thiểu</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="weight_to" class="form-label fw-bold">Đến (kg) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0" name="weight_to" id="weight_to" 
                                        value="{{ old('weight_to') }}" required
                                        class="form-control form-control-lg @error('weight_to') is-invalid @enderror"
                                        placeholder="0.00">
                                    @error('weight_to')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-2">Khối lượng tối đa</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="form-label fw-bold">Giá (VNĐ) <span class="text-danger">*</span></label>
                            <input type="number" step="1000" min="0" name="price" id="price" 
                                value="{{ old('price') }}" required
                                class="form-control form-control-lg @error('price') is-invalid @enderror"
                                placeholder="0">
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">Mức giá cho khoảng trọng lượng này (VNĐ)</small>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Mô tả</label>
                            <textarea name="description" id="description" rows="3" 
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Nhập mô tả thêm nếu cần (không bắt buộc)">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-2">Ví dụ: 'Hàng dễ vỡ', 'Giao nhanh', v.v.</small>
                        </div>

                        <div class="d-flex gap-2 justify-content-end mt-5">
                            <a href="{{ route('admin.parcel_prices.index') }}" class="btn btn-lg btn-secondary">
                                <i class='bx bx-x'></i> Hủy bỏ
                            </a>
                            <button type="submit" class="btn btn-lg btn-primary">
                                <i class='bx bx-check'></i> Lưu giá mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
