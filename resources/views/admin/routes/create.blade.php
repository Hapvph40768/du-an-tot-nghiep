@extends('layout.admin')
@section('content-main')
    <div class="container-fluid py-4">
        {{-- Thêm đoạn này để hiện lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger shadow-sm border-0 rounded-3">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h4 class="fw-bold mb-4">Thiết lập Tuyến đường mới</h4>
                    <form action="{{ route('admin.routes.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Điểm khởi hành <span class="text-danger">*</span></label>
                                    <select name="start_location_id"
                                        class="form-select rounded-3 @error('start_location_id') is-invalid @enderror">
                                        <option value="">-- Chọn điểm đi --</option>
                                        @foreach ($locations as $loc)
                                            <option value="{{ $loc->id }}"
                                                {{ old('start_location_id') == $loc->id ? 'selected' : '' }}>
                                                {{ $loc->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('start_location_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Điểm kết thúc <span class="text-danger">*</span></label>
                                    <select name="end_location_id"
                                        class="form-select rounded-3 @error('end_location_id') is-invalid @enderror">
                                        <option value="">-- Chọn điểm đến --</option>
                                        @foreach ($locations as $loc)
                                            <option value="{{ $loc->id }}"
                                                {{ old('end_location_id') == $loc->id ? 'selected' : '' }}>
                                                {{ $loc->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('end_location_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12 mt-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold small" for="isActive">Kích hoạt tuyến đường</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Khoảng cách (km)</label>
                                <input type="number" name="distance_km" class="form-control rounded-3"
                                    placeholder="Ví dụ: 300">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Thời gian dự kiến</label>
                            <div class="d-flex gap-2 align-items-center">
                                <div class="input-group" style="max-width: 130px;">
                                    <input type="number" name="estimated_hours" min="0" max="99"
                                        class="form-control rounded-3"
                                        placeholder="0" value="{{ old('estimated_hours', 0) }}">
                                    <span class="input-group-text bg-light text-muted">giờ</span>
                                </div>
                                <div class="input-group" style="max-width: 130px;">
                                    <input type="number" name="estimated_minutes" min="0" max="59"
                                        class="form-control rounded-3"
                                        placeholder="0" value="{{ old('estimated_minutes', 0) }}">
                                    <span class="input-group-text bg-light text-muted">phút</span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4"
                                style="background: #ff6b00; border:none; border-radius: 10px;">Lưu tuyến đường</button>
                            <a href="{{ route('admin.routes.index') }}" class="btn btn-light px-4 border">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
