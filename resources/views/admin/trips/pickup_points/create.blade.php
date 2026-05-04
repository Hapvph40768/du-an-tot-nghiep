@extends('layout.admin.AdminLayout')

@section('title', 'Thêm điểm đón cho chuyến xe')

@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Breadcrumb để Admin biết mình đang ở đâu --}}}<nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.trips.index') }}" class="text-decoration-none">{{{ __('trips') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.trips.pickup_points.index', $trip->id) }}" class="text-decoration-none">{{{ __('pickup_points') }} chuyến</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm mới & Gán</li>
                </ol>
            </nav>

            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="mb-4 border-bottom pb-3">
                    <h4 class="fw-bold m-0 text-dark">{{{ __('create_new') }} & Gán điểm đón</h4>
                    <p class="text-muted small m-0">
                        Địa điểm này sẽ được lưu vào <b>Danh mục gốc</b> và gán cho Chuyến: 
                        <span class="text-primary fw-bold">{{ $trip->route->departureLocation->name }}} → {{ $trip->route->destinationLocation->name }}}</span>
                    </p>
                </div>

                {{-- FORM ACTION: Gọi đúng hàm store_new của TripPickupPointController --}}}<form action="{{ route('admin.trips.pickup_points.store_new', $trip->id) }}" method="POST">
                    @csrf
                    
                    {{-- 1. Chọn Tỉnh/Thành phố --}}}<div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Thuộc Tỉnh/Thành phố</label>
                        <select name="location_id" class="form-select rounded-3 @error('location_id') is-invalid @enderror">
                            <option value="">-- Chọn vị trí --</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->name }}}</option>
                            @endforeach
                        </select>
                        @error('location_id') <div class="invalid-feedback">{{ $message }}}</div> @enderror
                    </div>

                    {{-- 2. Tên điểm đón --}}}<div class="mb-3">
                        <label class="form-label fw-bold small text-muted">{{{ __('name') }} điểm đón (Bến xe/Văn phòng/Điểm dừng)</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="form-control rounded-3 @error('name') is-invalid @enderror" 
                               placeholder="Ví dụ: Bến xe Miền Đông">
                        @error('name') <div class="invalid-feedback">{{ $message }}}</div> @enderror
                    </div>

                    {{-- 3. Địa chỉ chi tiết --}}}<div class="mb-4">
                        <label class="form-label fw-bold small text-muted">{{{ __('address') }} chi tiết</label>
                        <textarea name="address" rows="3" class="form-control rounded-3 @error('address') is-invalid @enderror" 
                                  placeholder="Số nhà, tên đường, phường/xã...">{{ old('address') }}}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}}</div> @enderror
                    </div>

                    <div class="pt-3 border-top d-flex gap-2">
                        {{-- Nút Lưu & Gán --}}}<button type="submit" class="btn btn-primary px-4 py-2 fw-bold" style="background: #ff6b00; border:none; border-radius: 10px;">
                            <i class='bx bx-save'></i> Lưu & Gán vào chuyến
                        </button>
                        
                        {{-- Nút Hủy: Quay lại trang index của đúng Trip đó --}}}<a href="{{ route('admin.trips.pickup_points.index', $trip->id) }}" class="btn btn-light px-4 border" style="border-radius: 10px;">
                            Hủy bỏ
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection