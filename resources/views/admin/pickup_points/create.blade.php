@extends('layout.admin.AdminLayout')

@section('title', 'Thêm điểm đón vào kho')

@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.pickup-points.index') }}" class="text-decoration-none">Danh mục gốc</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
                </ol>
            </nav>

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="mb-4">
                    <h4 class="fw-bold m-0 text-dark">Thêm Điểm đón vào kho gốc</h4>
                    <p class="text-muted small">{{ __('locations') }} này sẽ được dùng chung để gán cho nhiều chuyến xe khác nhau.</p>
                </div>

                {{ -- Sửa route: dùng dấu gạch nối 'pickup-points' -- }}<form action="{{ route('admin.pickup-points.store') }}" method="POST">
                    @csrf
                    
                    {{ -- Tỉnh/Thành phố -- }}<div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Tỉnh/Thành phố</label>
                        <select name="location_id" class="form-select @error('location_id') is-invalid @enderror">
                            <option value="">-- Chọn vị trí --</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->name }}</option>
                            @endforeach
                        </select>
                        @error('location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{ -- Tên điểm đón -- }}<div class="mb-3">
                        <label class="form-label fw-bold small text-muted">{{ __('name') }} điểm đón (Bến xe/Văn phòng)</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="form-control @error('name') is-invalid @enderror" 
                               placeholder="VD: Bến xe Miền Đông">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{ -- Địa chỉ chi tiết -- }}<div class="mb-4">
                        <label class="form-label fw-bold small text-muted">{{ __('address') }} chi tiết</label>
                        <textarea name="address" rows="3" 
                                  class="form-control @error('address') is-invalid @enderror" 
                                  placeholder="Số nhà, tên đường, phường/xã...">{{ old('address') }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex gap-2 border-top pt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" 
                                style="background: #ff6b00; border:none; border-radius: 8px;">
                            <i class='bx bx-save'></i> Lưu vào danh mục
                        </button>
                        <a href="{{ route('admin.pickup-points.index') }}" 
                           class="btn btn-light border px-4 py-2" style="border-radius: 8px;">{{ __('cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection