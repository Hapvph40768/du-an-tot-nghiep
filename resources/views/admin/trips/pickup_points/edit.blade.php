@extends('layout.admin.AdminLayout')

@section('title', 'Chỉnh sửa điểm đón')

@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="mb-4">
                    <h4 class="fw-bold m-0">Chỉnh sửa Điểm đón</h4>
                    <p class="text-muted small">{{ __('update') }} thông tin cho: <span class="text-primary">{{ $pickupPoint->name }}</span></p>
                </div>

                <form action="{{ route('admin.pickup-points.update', $pickupPoint->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Thuộc Tỉnh/Thành phố</label>
                        <select name="location_id" class="form-select rounded-3 @error('location_id') is-invalid @enderror">
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ (old('location_id', $pickupPoint->location_id) == $loc->id) ? 'selected' : '' }}>
                                    {{ $loc->name }}</option>
                            @endforeach
                        </select>
                        @error('location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">{{ __('name') }} điểm đón</label>
                        <input type="text" name="name" value="{{ old('name', $pickupPoint->name) }}" 
                               class="form-control rounded-3 @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small">{{ __('address') }} chi tiết</label>
                        <textarea name="address" rows="3" class="form-control rounded-3 @error('address') is-invalid @enderror">{{ old('address', $pickupPoint->address) }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4" style="background: #ff6b00; border:none; border-radius: 10px;">
                            <i class='bx bx-sync'></i> Cập nhật thay đổi
                        </button>
                        <a href="{{ route('admin.pickup-points.index') }}" class="btn btn-light px-4 border" style="border-radius: 10px;">{{ __('back') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection