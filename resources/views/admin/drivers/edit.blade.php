@extends('layout.admin')
@section('title', 'Sửa Tài xế')
@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="{{ route('admin.drivers.index') }}" class="btn btn-light border rounded-3">
                    <i class='bx bx-left-arrow-alt'></i>
                </a>
                <div>
                    <h4 class="fw-bold m-0">Chỉnh sửa Tài xế</h4>
                    <p class="text-muted small mb-0">{{ $driver->name }}</p>
                </div>
            </div>

            @if($errors->any())
            <div class="alert alert-danger border-0 rounded-3 small mb-4">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- THÔNG TIN CÁ NHÂN --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px; border-left:4px solid #ff6b00; padding-left:10px;">Thông tin cá nhân</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $driver->name) }}" class="form-control rounded-3 @error('name') is-invalid @enderror">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Ngày sinh</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $driver->date_of_birth) }}" class="form-control rounded-3 @error('date_of_birth') is-invalid @enderror">
                            @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Giới tính</label>
                            <select name="gender" class="form-select rounded-3 @error('gender') is-invalid @enderror">
                                <option value="">-- Chọn --</option>
                                <option value="male" {{ old('gender', $driver->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                                <option value="female" {{ old('gender', $driver->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
                                <option value="other" {{ old('gender', $driver->gender) == 'other' ? 'selected' : '' }}>Khác</option>
                            </select>
                            @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Số điện thoại</label>
                            <input type="text" name="phone" value="{{ old('phone', $driver->phone) }}" class="form-control rounded-3 @error('phone') is-invalid @enderror">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Email</label>
                            <input type="email" value="{{ $driver->user->email ?? $driver->email }}" class="form-control rounded-3 bg-light" readonly disabled>
                            <div class="form-text text-muted">Email không thể thay đổi</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">CCCD / CMND</label>
                            <input type="text" name="id_card_number" value="{{ old('id_card_number', $driver->id_card_number) }}" class="form-control rounded-3 @error('id_card_number') is-invalid @enderror">
                            @error('id_card_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Địa chỉ</label>
                            <input type="text" name="address" value="{{ old('address', $driver->address) }}" class="form-control rounded-3 @error('address') is-invalid @enderror">
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Ảnh đại diện</label>
                            @if($driver->avatar)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($driver->avatar) }}" class="rounded-3" style="height:60px; width:60px; object-fit:cover;" alt="Avatar">
                                </div>
                            @endif
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
                            <input type="text" name="license_number" value="{{ old('license_number', $driver->license_number) }}" class="form-control rounded-3 @error('license_number') is-invalid @enderror">
                            @error('license_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Hạng bằng lái</label>
                            <select name="license_class" class="form-select rounded-3">
                                <option value="">-- Chọn --</option>
                                @foreach(['A1','A2','B1','B2','C','D','E','F'] as $cls)
                                <option value="{{ $cls }}" {{ old('license_class', $driver->license_class) == $cls ? 'selected' : '' }}>{{ $cls }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold small">Số năm kinh nghiệm</label>
                            <input type="number" name="experience_years" value="{{ old('experience_years', $driver->experience_years) }}" min="0" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Ngày cấp bằng</label>
                            <input type="date" name="license_issued_date" value="{{ old('license_issued_date', $driver->license_issued_date) }}" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Ngày hết hạn bằng</label>
                            <input type="date" name="license_expiry_date" value="{{ old('license_expiry_date', $driver->license_expiry_date) }}" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Ảnh bằng lái</label>
                            @if($driver->license_image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($driver->license_image) }}" class="rounded-3 border" style="height:50px;" alt="Bằng lái">
                                </div>
                            @endif
                            <input type="file" name="license_image" accept="image/*" class="form-control rounded-3">
                        </div>
                    </div>
                </div>

                {{-- TRẠNG THÁI --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bold text-uppercase text-muted small mb-3" style="letter-spacing:1px; border-left:4px solid #ff6b00; padding-left:10px;">Trạng thái & Ghi chú</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Trạng thái</label>
                            <select name="status" class="form-select rounded-3 @error('status') is-invalid @enderror">
                                <option value="active" {{ old('status', $driver->status) == 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                                <option value="inactive" {{ old('status', $driver->status) == 'inactive' ? 'selected' : '' }}>Ngừng hoạt động</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold small">Ghi chú cá nhân</label>
                            <textarea name="personal_info" rows="2" class="form-control rounded-3">{{ old('personal_info', $driver->personal_info) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn px-4 py-2 fw-bold text-white" style="background:#ff6b00; border-radius:10px;">
                        <i class='bx bx-save'></i> Lưu thay đổi
                    </button>
                    <a href="{{ route('admin.drivers.index') }}" class="btn btn-light border px-4 py-2 rounded-3">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
