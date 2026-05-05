@extends('layout.admin.AdminLayout')
@section('content-main')
    <div class="container-fluid py-4">
        {{-- Thêm đoạn này để hiện lỗi --}} @if ($errors->any())
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
                                    <label class="form-label fw-bold small">Điểm kết thúc</label>
                                    {{-- Đổi name thành end_location_id --}}<select name="end_location_id"
                                        class="form-select rounded-3 @error('end_location_id') is-invalid @enderror">
                                        <option value="">-- Chọn điểm đến --</option>
                                        @foreach ($locations as $loc)
                                            <option value="{{ $loc->id }}"
                                                {{ old('end_location_id') == $loc->id ? 'selected' : '' }}>
                                                {{ $loc->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('end_location_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Các trường distance và duration giữ nguyên nhưng nên thêm @error để hiện lỗi đỏ --}}</div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Khoảng cách (km)</label>
                                <input type="number" name="distance_km" class="form-control rounded-3"
                                    placeholder="Ví dụ: 300">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Thời gian dự kiến (giờ)</label>
                                <input type="number" step="0.1" name="estimated_time" class="form-control rounded-3"
                                    placeholder="Ví dụ: 5.5">
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4"
                                style="background: #ff6b00; border:none; border-radius: 10px;">{{ __('save') }} tuyến đường</button>
                            <a href="{{ route('admin.routes.index') }}" class="btn btn-light px-4 border">{{ __('cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
