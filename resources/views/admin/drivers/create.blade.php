@extends('layout.admin')
@section('title', 'Thêm Tài xế mới')
@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="{{ route('admin.drivers.index') }}" class="btn btn-light border rounded-3">
                    <i class='bx bx-left-arrow-alt'></i>
                </a>
                <div>
                    <h4 class="fw-bold m-0">Thêm Tài xế mới</h4>
                    <p class="text-muted small mb-0">Điền đầy đủ thông tin để tạo hồ sơ tài xế</p>
                </div>
            </div>

            @if($errors->any())
            <div class="alert alert-danger border-0 rounded-3 small mb-4">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- THÔNG TIN CÁ NHÂN --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px; border-left:4px solid #ff6b00; padding-left:10px;">Thông tin cá nhân</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-3 @error('name') is-invalid @enderror" placeholder="Nguyễn Văn A">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Ngày sinh</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control rounded-3 @error('date_of_birth') is-invalid @enderror">
                            @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Giới tính</label>
                            <select name="gender" class="form-select rounded-3 @error('gender') is-invalid @enderror">
                                <option value="">-- Chọn --</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
                            </select>
                            @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Số điện thoại</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control rounded-3 @error('phone') is-invalid @enderror" placeholder="0901234567">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-3 @error('email') is-invalid @enderror" placeholder="taixe@example.com">
                            <div class="form-text">Dùng để đăng nhập, mật khẩu mặc định = email</div>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">CCCD / CMND</label>
                            <input type="text" name="id_card_number" value="{{ old('id_card_number') }}" class="form-control rounded-3 @error('id_card_number') is-invalid @enderror" placeholder="012345678901">
                            @error('id_card_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Địa chỉ</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control rounded-3 @error('address') is-invalid @enderror" placeholder="Số nhà, đường, phường, tỉnh...">
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Ảnh đại diện</label>
                            <input type="file" name="avatar" accept="image/*" class="form-control rounded-3 @error('avatar') is-invalid @enderror">
                            @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- THÔNG TIN BẰNG LÁI --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px; border-left:4px solid #ff6b00; padding-left:10px;">Thông tin Bằng lái xe</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Số bằng lái</label>
                            <input type="text" name="license_number" value="{{ old('license_number') }}" class="form-control rounded-3 @error('license_number') is-invalid @enderror" placeholder="VD: 012345678901">
                            @error('license_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Hạng bằng lái</label>
                            <select name="license_class" class="form-select rounded-3 @error('license_class') is-invalid @enderror">
                                <option value="">-- Chọn hạng --</option>
                                @foreach(['A1','A2','B1','B2','C','D','E','F'] as $cls)
                                <option value="{{ $cls }}" {{ old('license_class') == $cls ? 'selected' : '' }}>{{ $cls }}</option>
                                @endforeach
                            </select>
                            @error('license_class')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Số năm kinh nghiệm</label>
                            <input type="number" name="experience_years" value="{{ old('experience_years', 0) }}" min="0" class="form-control rounded-3 @error('experience_years') is-invalid @enderror">
                            @error('experience_years')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Ngày cấp bằng</label>
                            <input type="date" name="license_issued_date" value="{{ old('license_issued_date') }}" class="form-control rounded-3 @error('license_issued_date') is-invalid @enderror">
                            @error('license_issued_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Ngày hết hạn bằng</label>
                            <input type="date" name="license_expiry_date" value="{{ old('license_expiry_date') }}" class="form-control rounded-3 @error('license_expiry_date') is-invalid @enderror">
                            @error('license_expiry_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Ảnh bằng lái</label>
                            <input type="file" name="license_image" accept="image/*" class="form-control rounded-3 @error('license_image') is-invalid @enderror">
                            @error('license_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- TRẠNG THÁI --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px; border-left:4px solid #ff6b00; padding-left:10px;">Trạng thái & Ghi chú</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Trạng thái <span class="text-danger">*</span></label>
                            <select name="status" class="form-select rounded-3 @error('status') is-invalid @enderror">
                                <option value="active" {{ old('status','active') == 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Ngừng hoạt động</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold small">Ghi chú cá nhân</label>
                            <textarea name="personal_info" rows="2" class="form-control rounded-3 @error('personal_info') is-invalid @enderror" placeholder="Ghi chú thêm về tài xế...">{{ old('personal_info') }}</textarea>
                            @error('personal_info')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn px-4 py-2 fw-bold text-white" style="background:#ff6b00; border-radius:10px;">
                        <i class='bx bx-save'></i> Lưu tài xế
                    </button>
                    <a href="{{ route('admin.drivers.index') }}" class="btn btn-light border px-4 py-2 rounded-3">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
