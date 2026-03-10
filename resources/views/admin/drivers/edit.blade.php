@extends('layout.admin.AdminLayout')

@section('title', 'Cập nhật Tài xế')

@section('content-main')
<style>
    .form-control-custom {
        background-color: #f8f9fa;
        border: 1px solid transparent;
        padding: 12px 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .form-control-custom:focus {
        background-color: #fff;
        border-color: #f97316;
        box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
    }
    .form-label { font-weight: 600; color: #374151; font-size: 0.9rem; margin-bottom: 8px; }
    
    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        background: #f8fafc;
        transition: all 0.3s;
        cursor: pointer;
        overflow: hidden;
    }
    .upload-box:hover { border-color: #f97316; }
</style>

<div class="container-fluid py-4">
    
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('drivers.index') }}" class="text-decoration-none text-muted fw-bold small hover-orange">
                <i class='bx bx-arrow-back me-1'></i> Quay lại
            </a>
            <h3 class="fw-bold text-dark mt-2">Cập nhật: <span class="text-primary" style="color: #f97316 !important;">{{ $driver->name }}</span></h3>
        </div>
        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">ID: #{{ $driver->id }}</span>
    </div>

    <form action="{{ route('drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 p-lg-5">
                        <h5 class="fw-bold mb-4" style="color: #f97316;"><i class='bx bx-edit me-2'></i>Chỉnh sửa thông tin</h5>
                        
                        <div class="mb-4">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="name" class="form-control form-control-custom" value="{{ old('name', $driver->name) }}" required>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại</label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light text-muted rounded-start-3"><i class='bx bx-phone'></i></span>
                                    <input type="text" name="phone" class="form-control form-control-custom rounded-end-3" value="{{ old('phone', $driver->phone) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số bằng lái (GPLX)</label>
                                <input type="text" name="license_number" class="form-control form-control-custom" value="{{ old('license_number', $driver->license_number) }}" required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="form-label">Trạng thái</label>
                            <div class="d-flex gap-3 flex-wrap mt-2">
                                <div class="form-check p-3 border rounded-3 bg-light">
                                    <input class="form-check-input" type="radio" name="status" value="active" id="st1" {{ $driver->status == 'active' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold text-success" for="st1">🟢 Hoạt động</label>
                                </div>
                                <div class="form-check p-3 border rounded-3 bg-light">
                                    <input class="form-check-input" type="radio" name="status" value="busy" id="st2" {{ $driver->status == 'busy' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold text-warning" for="st2">🟠 Đang chạy</label>
                                </div>
                                <div class="form-check p-3 border rounded-3 bg-light">
                                    <input class="form-check-input" type="radio" name="status" value="inactive" id="st3" {{ $driver->status == 'inactive' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold text-secondary" for="st3">⚫ Đã nghỉ</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 text-center">
                        <h5 class="fw-bold mb-4 text-start" style="color: #f97316;"><i class='bx bx-image me-2'></i>Ảnh đại diện</h5>
                        
                        <label for="imageUpload" class="upload-box d-block position-relative mx-auto" style="width: 100%; height: 250px;">
                            <img id="preview-img" 
                                 src="{{ $driver->image ? asset($driver->image) : 'https://via.placeholder.com/300x300?text=Upload+New' }}" 
                                 class="w-100 h-100 object-fit-cover">
                            
                            <div class="position-absolute bottom-0 start-0 w-100 bg-dark bg-opacity-50 text-white py-2 small">
                                <i class='bx bx-camera'></i> Nhấn để đổi ảnh
                            </div>
                        </label>
                        
                        <input type="file" name="image" id="imageUpload" class="d-none" accept="image/*" onchange="previewFile(this)">
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary bg-gradient border-0 py-3 fw-bold rounded-3 shadow-lg" style="background-color: #f97316;">
                        <i class='bx bx-check-double me-2'></i> CẬP NHẬT
                    </button>
                    <a href="{{ route('drivers.index') }}" class="btn btn-light py-3 fw-bold rounded-3 text-muted">Hủy bỏ</a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewFile(input) {
        var file = input.files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                document.getElementById('preview-img').src = reader.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>


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