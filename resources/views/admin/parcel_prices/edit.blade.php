@extends('layout.admin')

@section('header-title', 'CHỈNH SỬA GIÁ KÝ GỬI')
@section('header-subtitle', 'Cập nhật thông tin giá ký gửi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-bottom p-4">
                    <h5 class="fw-bold mb-0">
                        {{ $parcelPrice->route->departureLocation->name ?? '...' }} 
                        <i class="fas fa-arrow-right text-muted mx-2"></i> 
                        {{ $parcelPrice->route->destinationLocation->name ?? '...' }}
                    </h5>
                </div>

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

                    <form action="{{ route('admin.parcel_prices.update', $parcelPrice->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="route_id" class="form-label fw-bold">Tuyến đường <span class="text-danger">*</span></label>
                            <select name="route_id" id="route_id" class="form-control form-control-lg @error('route_id') is-invalid @enderror" required>
                                <option value="">-- Chọn tuyến --</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}" {{ old('route_id', $parcelPrice->route_id) == $route->id ? 'selected' : '' }}>
                                        {{ $route->departureLocation->name ?? '...' }} → {{ $route->destinationLocation->name ?? '...' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('route_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="weight_from" class="form-label fw-bold">Từ (kg) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0" name="weight_from" id="weight_from" 
                                        value="{{ old('weight_from', $parcelPrice->weight_from) }}" required
                                        class="form-control form-control-lg @error('weight_from') is-invalid @enderror">
                                    @error('weight_from')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="weight_to" class="form-label fw-bold">Đến (kg) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0" name="weight_to" id="weight_to" 
                                        value="{{ old('weight_to', $parcelPrice->weight_to) }}" required
                                        class="form-control form-control-lg @error('weight_to') is-invalid @enderror">
                                    @error('weight_to')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="form-label fw-bold">Giá (VNĐ) <span class="text-danger">*</span></label>
                            <input type="number" step="1000" min="0" name="price" id="price" 
                                value="{{ old('price', $parcelPrice->price) }}" required
                                class="form-control form-control-lg @error('price') is-invalid @enderror">
                            @error('price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Mô tả</label>
                            <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $parcelPrice->description) }}</textarea>
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
                                <i class='bx bx-check'></i> Cập nhật giá
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
