@extends('layout.admin.AdminLayout')

@section('content-main')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <div class="d-flex align-items-center mb-4 text-primary">
                        <i class='bx bx-bus fs-2 me-2'></i>
                        <h3 class="fw-bold m-0">Thêm Xe mới</h3>
                    </div>

                    <div class="alert alert-info border-0 small mb-4">
                        <i class='bx bx-info-circle'></i> Hệ thống sẽ <strong>tự động tạo sơ đồ ghế</strong> sau khi bạn lưu
                        thông tin xe.
                    </div>

                    <form action="{{ route('admin.vehicles.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Biển số xe</label>
                            <input type="text" name="license_plate"
                                class="form-control rounded-3 @error('license_plate') is-invalid @enderror"
                                value="{{ old('license_plate') }}" placeholder="VD: 51B-123.45" required>
                            @error('license_plate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Loại xe</label>
                            <input type="text" name="type"
                                class="form-control rounded-3 @error('type') is-invalid @enderror"
                                value="{{ old('type') }}" placeholder="VD: Limousine 9 chỗ / Giường nằm 40 chỗ" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">{{ __('total') }} số ghế</label>
                                <input type="number" name="total_seats"
                                    class="form-control rounded-3 @error('total_seats') is-invalid @enderror"
                                    value="{{ old('total_seats') }}" min="1" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Số điện thoại</label>
                                <input type="text" name="phone_vehicles"
                                    class="form-control rounded-3 @error('phone_vehicles') is-invalid @enderror"
                                    value="{{ old('phone_vehicles') }}" placeholder="VD: 0901234567">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">{{ __('status') }}</label>
                                <select name="status" class="form-select rounded-3">
                                    <option value="active">Đang hoạt động</option>
                                    <option value="maintenance">Đang bảo trì</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Vị trí bãi đỗ xe</label>
                                <select name="parking_slot_id" class="form-select rounded-3">
                                    <option value="">-- Không xếp bãi --</option>
                                    @foreach ($parkings as $parking)
                                        @if ($parking->slots->count() > 0)
                                            <optgroup label="{{ $parking->name }} ({{ $parking->location }})">
                                                @foreach ($parking->slots as $slot)
                                                    <option value="{{ $slot->id }}"
                                                        {{ old('parking_slot_id') == $slot->id ? 'selected' : '' }}>
                                                        {{ $slot->slot_code }} - {{ $slot->zone }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4"
                                style="background: #ff6b00; border:none; border-radius: 10px; height: 45px;">
                                Lưu & Tạo sơ đồ ghế
                            </button>
                            <a href="{{ route('admin.vehicles.index') }}" class="btn btn-light px-4 border ms-2"
                                style="border-radius: 10px; height: 45px;">{{ __('cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
