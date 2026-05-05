@extends('layout.admin.AdminLayout')

@section('title', 'Sửa điểm đón')

@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Breadcrumb để dễ quay lại --}}<nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.pickup-points.index') }}" class="text-decoration-none">Danh mục gốc</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa</li>
                </ol>
            </nav>

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="mb-4">
                    <h4 class="fw-bold m-0 text-dark">Chỉnh sửa Điểm đón</h4>
                    <p class="text-muted small">{{ __('update') }} thông tin bến xe/điểm dừng trong hệ thống</p>
                </div>

                {{-- Cập nhật route sang dấu gạch nối 'pickup-points' --}}<form action="{{ route('admin.pickup-points.update', $pickupPoint->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- Tỉnh/Thành phố --}}<div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Tỉnh/Thành phố</label>
                        <select name="location_id" class="form-select @error('location_id') is-invalid @enderror">
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ (old('location_id', $pickupPoint->location_id) == $loc->id) ? 'selected' : '' }}>
                                    {{ $loc->name }}</option>
                            @endforeach
                        </select>
                        @error('location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Tên điểm đón --}}<div class="mb-3">
                        <label class="form-label fw-bold small text-muted">{{ __('name') }} điểm đón</label>
                        <input type="text" name="name" value="{{ old('name', $pickupPoint->name) }}" 
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="VD: Bến xe Miền Đông">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Địa chỉ chi tiết --}}<div class="mb-4">
                        <label class="form-label fw-bold small text-muted">{{ __('address') }} chi tiết</label>
                        <textarea name="address" rows="3" 
                                  class="form-control @error('address') is-invalid @enderror"
                                  placeholder="Số nhà, tên đường...">{{ old('address', $pickupPoint->address) }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2 border-top pt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" 
                                style="background: #ff6b00; border:none; border-radius: 8px;">
                            <i class='bx bx-save'></i> Cập nhật thay đổi
                        </button>
                        <a href="{{ route('admin.pickup-points.index') }}" 
                           class="btn btn-light border px-4 py-2" style="border-radius: 8px;">{{ __('cancel') }} bỏ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection