@extends('layout.admin.AdminLayout')

@section('title', 'Chỉnh sửa Địa điểm')

@section('content-main')

    <style>
        :root {
            --primary-color: #ff6b00;
            --primary-hover: #e65100;
            --bg-light: #f9fafb;
        }

        .card-box {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0f0f0;
            padding: 24px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
            margin-bottom: 8px;
        }

        .form-control-custom,
        .form-select-custom {
            background-color: var(--bg-light);
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.2s;
        }

        .form-control-custom:focus,
        .form-select-custom:focus {
            background-color: #fff;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.1);
            outline: none;
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 107, 0, 0.25);
        }

        .btn-outline-danger-custom {
            border-color: #dc2626;
            color: #dc2626;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-outline-danger-custom:hover {
            background-color: #fee2e2;
        }

        .btn-outline-secondary-custom {
            border-color: #d1d5db;
            color: #4b5563;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-outline-secondary-custom:hover {
            background-color: #f3f4f6;
        }
    </style>

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('admin.locations.index') }}" class="text-decoration-none text-muted fw-bold small">
                    <i class='bx bx-arrow-back me-1'></i> Quay lại danh sách
                </a>
                <h2 class="fw-bold text-dark mt-2">Chỉnh sửa: <span
                        style="color: var(--primary-color);">{{ $location->name }}</span></h2>
            </div>
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">ID: #{{ $location->id }}</span>
        </div>

        <div class="card-box">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <strong>Lỗi nhập liệu:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.locations.update', $location->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <div class="col-lg-8">
                        <input type="hidden" name="latitude" value="{{ old('latitude', $location->latitude) }}">
                        <input type="hidden" name="longitude" value="{{ old('longitude', $location->longitude) }}">
                        <div class="mb-4">
                            <label for="name" class="form-label">Tên địa điểm <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control form-control-custom @error('name') is-invalid @enderror"
                                value="{{ old('name', $location->name) }}" placeholder="Ví dụ: Bến xe Mỹ Đình" required
                                autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label">Địa chỉ chi tiết</label>
                            <input type="text" name="address" id="address"
                                class="form-control form-control-custom @error('address') is-invalid @enderror"
                                value="{{ old('address', $location->address) }}" placeholder="Số nhà, đường, phường/xã...">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="city" class="form-label">Thành phố / Tỉnh</label>
                                <input type="text" name="city" id="city"
                                    class="form-control form-control-custom @error('city') is-invalid @enderror"
                                    value="{{ old('city', $location->city) }}"
                                    placeholder="Hà Nội, TP. Hồ Chí Minh, Đà Nẵng...">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="province_code" class="form-label">Mã tỉnh (tùy chọn)</label>
                                <input type="text" name="province_code" id="province_code"
                                    class="form-control form-control-custom @error('province_code') is-invalid @enderror"
                                    value="{{ old('province_code', $location->province_code) }}"
                                    placeholder="HN, HCM, DN...">
                                @error('province_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="note" class="form-label">Ghi chú / Thông tin bổ sung</label>
                            <textarea name="note" id="note" rows="3"
                                class="form-control form-control-custom @error('note') is-invalid @enderror"
                                placeholder="Ví dụ: Bến chính, có bãi đỗ xe lớn...">{{ old('note', $location->note ?? '') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-lg-4">

                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3" style="color: var(--primary-color);">
                                    <i class='bx bx-toggle-left me-2'></i>Trạng thái
                                </h5>

                                <div class="form-check form-switch form-switch-lg">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                        value="1" {{ old('is_active', $location->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active">
                                        Hoạt động (hiển thị cho khách hàng)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary-custom btn-lg">
                                <i class='bx bx-save me-2'></i> CẬP NHẬT ĐỊA ĐIỂM
                            </button>

                            <a href="{{ route('admin.locations.index') }}"
                                class="btn btn-outline-secondary-custom btn-lg text-center">
                                Hủy bỏ
                            </a>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </div>

@endsection
