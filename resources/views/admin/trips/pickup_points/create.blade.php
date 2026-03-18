@extends('layout.admin.AdminLayout')

@section('title', 'Thêm điểm đón mới')

@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <div class="mb-4">
                    <h4 class="fw-bold m-0">Thêm Điểm đón mới</h4>
                    <p class="text-muted small">Tạo điểm dừng chân cố định trong danh mục</p>
                </div>

                <form action="{{ route('admin.trips.pickup_points.store_new', $trip->id) }}" method="POST">
                    @csrf
                    
                    {{-- Chọn Tỉnh/Thành phố --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Thuộc Tỉnh/Thành phố</label>
                        <select name="location_id" class="form-select rounded-3 @error('location_id') is-invalid @enderror">
                            <option value="">-- Chọn vị trí --</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Tên điểm đón --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Tên điểm đón (Bến xe/Văn phòng/Điểm dừng)</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="form-control rounded-3 @error('name') is-invalid @enderror" 
                               placeholder="Ví dụ: Bến xe Miền Đông">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Địa chỉ chi tiết --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold small">Địa chỉ chi tiết</label>
                        <textarea name="address" rows="3" class="form-control rounded-3 @error('address') is-invalid @enderror" 
                                  placeholder="Số nhà, tên đường, phường/xã...">{{ old('address') }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4" style="background: #ff6b00; border:none; border-radius: 10px;">
                            <i class='bx bx-save'></i> Lưu điểm đón
                        </button>
                        <a href="{{ route('admin.trips.pickup_points.index', $trip->id) }}" class="btn btn-light px-4 border" style="border-radius: 10px;">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection