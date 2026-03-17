@extends('layout.admin.AdminLayout')

@section('content-main')

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">

        <form action="{{ route('admin.locations.update', $location->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div style="grid-column: span 2;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Tên địa điểm <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="text" name="name"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('name', $location->name) }}" placeholder="Ví dụ: Bến xe Mỹ Đình" required autofocus>
                    @error('name')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="grid-column: span 2;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Địa chỉ chi tiết
                    </label>
                    <input type="text" name="address"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('address', $location->address) }}" placeholder="Số nhà, đường, phường/xã...">
                    @error('address')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Thành phố / Tỉnh
                    </label>
                    <input type="text" name="city"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('city', $location->city) }}" placeholder="Hà Nội, TP. Hồ Chí Minh, Đà Nẵng...">
                    @error('city')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Mã tỉnh (tùy chọn)
                    </label>
                    <input type="text" name="province_code"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('province_code', $location->province_code) }}" placeholder="HN, HCM, DN...">
                    @error('province_code')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                    Ghi chú / Thông tin bổ sung (tùy chọn)
                </label>
                <textarea name="note" rows="4"
                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; resize: vertical;"
                    placeholder="Ví dụ: Bến chính, có bãi đỗ xe lớn, gần trung tâm...">{{ old('note', $location->note ?? '') }}</textarea>
                @error('note')
                    <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                    Trạng thái <span style="color: #ff5b24;">*</span>
                </label>
                <select name="is_active"
                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                    required>
                    <option value="1" {{ old('is_active', $location->is_active ? 1 : 0) == 1 ? 'selected' : '' }}>
                        Đang hoạt động
                    </option>
                    <option value="0" {{ old('is_active', $location->is_active ? 1 : 0) == 0 ? 'selected' : '' }}>
                        Tạm ngưng
                    </option>
                </select>
                @error('is_active')
                    <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            {{-- <input type="hidden" name="latitude" value="{{ old('latitude', $location->latitude) }}">
            <input type="hidden" name="longitude" value="{{ old('longitude', $location->longitude) }}"> --}}

            <div style="display: flex; gap: 12px; justify-content: flex-start;">
                <button type="submit"
                    style="background-color: #ff5b24; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px;">
                    Cập nhật địa điểm
                </button>
                <a href="{{ route('admin.locations.index') }}"
                    style="display: inline-flex; align-items: center; background-color: #f0f2f5; color: #333; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">
                    Hủy
                </a>
            </div>
        </form>
    </div>

@endsection
