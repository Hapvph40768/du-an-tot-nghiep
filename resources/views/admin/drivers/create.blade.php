@extends('layout.admin.AdminLayout')
@section('title', 'Thêm Tài xế mới')

@section('content-main')
<style>
    /* Input Style hiện đại - Giống Google Material */
    .form-control-custom {
        background-color: #f8f9fa;
        border: 1px solid transparent;
        padding: 12px 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .form-control-custom:focus {
        background-color: #fff;
        border-color: #f97316; /* Màu cam */
        box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
    }
    .form-label { font-weight: 600; color: #374151; font-size: 0.9rem; margin-bottom: 8px; }
    
    /* Upload Box Style */
    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        background: #f8fafc;
        transition: all 0.3s;
        cursor: pointer;
    }
    .upload-box:hover { border-color: #f97316; background: #fff7ed; }
</style>

<div class="container-fluid py-4">
    
    <div class="mb-4">
        <a href="{{ route('drivers.index') }}" class="text-decoration-none text-muted fw-bold small hover-orange">
            <i class='bx bx-arrow-back me-1'></i> Quay lại danh sách
        </a>
        <h3 class="fw-bold text-dark mt-2">Thêm Tài xế mới</h3>
    </div>

    <form action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 p-lg-5">
                        <h5 class="fw-bold mb-4 text-primary-orange"><i class='bx bx-info-circle me-2'></i>Thông tin cá nhân</h5>
                        
                        <div class="mb-4">
                            <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control form-control-custom" placeholder="Ví dụ: Nguyễn Văn A" required>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light text-muted rounded-start-3"><i class='bx bx-phone'></i></span>
                                    <input type="text" name="phone" class="form-control form-control-custom rounded-end-3" placeholder="09xxxxxxxx" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số bằng lái (GPLX) <span class="text-danger">*</span></label>
                                <input type="text" name="license_number" class="form-control form-control-custom" placeholder="Ví dụ: B2-123456" required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="form-label">Trạng thái làm việc</label>
                            <div class="d-flex gap-4 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="active" id="st1" checked>
                                    <label class="form-check-label" for="st1">🟢 Đang hoạt động</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="busy" id="st2">
                                    <label class="form-check-label" for="st2">🟠 Đang chạy xe</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="inactive" id="st3">
                                    <label class="form-check-label" for="st3">⚫ Đã nghỉ việc</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 text-center">
                        <h5 class="fw-bold mb-4 text-start text-primary-orange"><i class='bx bx-image me-2'></i>Ảnh đại diện</h5>
                        
                        <label for="imageUpload" class="upload-box d-block p-4 mb-3 position-relative">
                            <div id="placeholder-view">
                                <i class='bx bx-cloud-upload fs-1 text-muted mb-2'></i>
                                <p class="text-muted small mb-0">Nhấn để tải ảnh lên</p>
                            </div>
                            <img id="preview-img" src="#" class="d-none w-100 rounded-3 shadow-sm object-fit-cover" style="height: 200px;">
                        </label>
                        
                        <input type="file" name="image" id="imageUpload" class="d-none" accept="image/*" 
                               onchange="previewFile(this)">
                        
                        <p class="small text-muted fst-italic">* Hỗ trợ: JPG, PNG, JPEG (Tối đa 2MB)</p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 bg-transparent shadow-none">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary bg-gradient border-0 py-3 fw-bold rounded-3 shadow-sm" style="background-color: #f97316;">
                            <i class='bx bx-save me-2'></i> LƯU THÔNG TIN
                        </button>
                        <button type="reset" class="btn btn-light py-3 fw-bold rounded-3 text-muted">
                            <i class='bx bx-refresh me-2'></i> Làm mới
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Script xem trước ảnh đơn giản
    function previewFile(input) {
        var file = input.files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                document.getElementById('preview-img').src = reader.result;
                document.getElementById('preview-img').classList.remove('d-none');
                document.getElementById('placeholder-view').classList.add('d-none');
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection