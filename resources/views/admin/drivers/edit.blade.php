@extends('layout.admin.AdminLayout')

@section('title', 'Cập nhật Tài xế')

@section('content-main')

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">

        <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Tên tài xế <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="text" name="name"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('name', $driver->name) }}" required autofocus>
                    @error('name')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Số điện thoại <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="text" name="phone"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('phone', $driver->phone) }}" required>
                    @error('phone')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Số bằng lái <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="text" name="license_number"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('license_number', $driver->license_number) }}" required>
                    @error('license_number')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Số năm kinh nghiệm
                    </label>
                    <input type="number" name="experience_years"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('experience_years', $driver->experience_years ?? 0) }}" min="0">
                    @error('experience_years')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Trạng thái <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="status"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        required>
                        <option value="active" {{ old('status', $driver->status) == 'active' ? 'selected' : '' }}>
                            Đang hoạt động
                        </option>
                        <option value="busy" {{ old('status', $driver->status) == 'busy' ? 'selected' : '' }}>
                            Đang chạy
                        </option>
                        <option value="inactive" {{ old('status', $driver->status) == 'inactive' ? 'selected' : '' }}>
                            Đã nghỉ
                        </option>
                    </select>
                    @error('status')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                    Thông tin cá nhân / Ghi chú (tùy chọn)
                </label>
                <textarea name="personal_info" rows="4"
                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; resize: vertical;">{{ old('personal_info', $driver->personal_info ?? '') }}</textarea>
                @error('personal_info')
                    <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-start;">
                <button type="submit"
                    style="background-color: #ff5b24; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px;">
                    Cập nhật tài xế
                </button>
                <a href="{{ route('admin.drivers.index') }}"
                    style="display: inline-flex; align-items: center; background-color: #f0f2f5; color: #333; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">
                    Hủy
                </a>
            </div>
        </form>
    </div>

@endsection
