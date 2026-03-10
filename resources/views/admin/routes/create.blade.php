@extends('layout.admin.AdminLayout')
@section('content-main')

<div class="top-header">
    <div class="header-title">
        <h1>Tạo Tuyến Xe Mới</h1>
        <p>Thêm một tuyến xe mới vào hệ thống</p>
    </div>
</div>

<div style="max-width: 800px;">
    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
        @if ($errors->any())
            <div style="background-color: #fee; border: 1px solid #fcc; color: #c33; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
                <strong>Lỗi:</strong>
                <ul style="margin: 8px 0 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('routes.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Điểm bắt đầu <span style="color: #ff5b24;">*</span></label>
                    <select name="start_location_id" style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" required>
                        <option value="">-- Chọn điểm --</option>
                        @forelse($locations as $location)
                            <option value="{{ $location->id }}" @selected(old('start_location_id') == $location->id)>{{ $location->name }}</option>
                        @empty
                            <option value="" disabled>Chưa có địa điểm</option>
                        @endforelse
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Điểm đến <span style="color: #ff5b24;">*</span></label>
                    <select name="end_location_id" style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" required>
                        <option value="">-- Chọn điểm --</option>
                        @forelse($locations as $location)
                            <option value="{{ $location->id }}" @selected(old('end_location_id') == $location->id)>{{ $location->name }}</option>
                        @empty
                            <option value="" disabled>Chưa có địa điểm</option>
                        @endforelse
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Khoảng cách (km) <span style="color: #ff5b24;">*</span></label>
                    <input type="number" name="distance_km" style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" value="{{ old('distance_km') }}" min="1" required>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Thời gian dự kiến (phút) <span style="color: #ff5b24;">*</span></label>
                    <input type="number" name="estimated_time" style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" value="{{ old('estimated_time') }}" min="1" required>
                </div>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="background-color: #ff5b24; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px;">Tạo tuyến xe</button>
                <a href="{{ route('routes.index') }}" style="display: inline-flex; align-items: center; background-color: #f0f2f5; color: #333; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">Hủy</a>
            </div>
        </form>
    </div>
</div>

@endsection