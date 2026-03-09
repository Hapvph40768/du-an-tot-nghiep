@extends('layout.admin.AdminLayout')

@section('content-main')
<div class="container-fluid py-4">
    <div class="row mb-3">
        <div class="col-12">
            <h2 class="fw-bold">Chỉnh sửa thông tin tài xế</h2>
            <p class="text-muted">Cập nhật dữ liệu cho tài xế: <span class="text-primary fw-bold">{{ $driver->name }}</span></p>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            {{-- Form gửi request cập nhật --}}
            <form action="{{ route('drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label fw-bold">Tên tài xế <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name', $driver->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" name="phone" id="phone" 
                               class="form-control @error('phone') is-invalid @enderror" 
                               value="{{ old('phone', $driver->phone) }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="license_number" class="form-label fw-bold">Số bằng lái <span class="text-danger">*</span></label>
                        <input type="text" name="license_number" id="license_number" 
                               class="form-control @error('license_number') is-invalid @enderror" 
                               value="{{ old('license_number', $driver->license_number) }}" required>
                        @error('license_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="experience_years" class="form-label fw-bold">Số năm kinh nghiệm</label>
                        <div class="input-group">
                            <input type="number" name="experience_years" id="experience_years" min="0" max="50"
                                   class="form-control @error('experience_years') is-invalid @enderror" 
                                   value="{{ old('experience_years', $driver->experience_years) }}">
                            <span class="input-group-text">Năm</span>
                            @error('experience_years')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="active" {{ old('status', $driver->status) == 'active' ? 'selected' : '' }}>Sẵn sàng (Active)</option>
                            <option value="busy" {{ old('status', $driver->status) == 'busy' ? 'selected' : '' }}>Đang bận (Busy)</option>
                            <option value="inactive" {{ old('status', $driver->status) == 'inactive' ? 'selected' : '' }}>Ngừng hoạt động (Inactive)</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label fw-bold">Ảnh đại diện (Tùy chọn)</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        @if($driver->image)
                            <div class="mt-2">
                                <small class="text-muted d-block mb-1">Ảnh hiện tại:</small>
                                <img src="{{ asset($driver->image) }}" alt="Avatar" class="img-thumbnail" style="max-height: 80px; object-fit: cover;">
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mb-4">
                        <label for="personal_info" class="form-label fw-bold">Thông tin cá nhân / Ghi chú</label>
                        <textarea name="personal_info" id="personal_info" rows="3"
                                  class="form-control @error('personal_info') is-invalid @enderror">{{ old('personal_info', $driver->personal_info) }}</textarea>
                        @error('personal_info')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="text-muted">
                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('drivers.index') }}" class="btn btn-secondary px-4">Hủy / Quay lại</a>
                    <button type="submit" class="btn btn-primary px-4">Cập nhật Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection