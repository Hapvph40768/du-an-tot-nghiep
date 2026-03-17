@extends('layout.admin.AdminLayout')

@section('title', 'Chỉnh sửa xe')

@section('content-main')

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">

        <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Biển số xe <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="text" name="license_plate"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('license_plate', $vehicle->license_plate) }}" placeholder="Ví dụ: 29A-12345" required
                        autofocus>
                    @error('license_plate')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Loại xe
                    </label>
                    <input type="text" name="type"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('type', $vehicle->type) }}" placeholder="Ví dụ: Limousine, Xe 16 chỗ...">
                    @error('type')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Số chỗ ngồi <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="number" name="total_seats"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('total_seats', $vehicle->total_seats) }}" min="2" max="100" required>
                    @error('total_seats')
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
                        <option value="" disabled {{ old('status', $vehicle->status) ? '' : 'selected' }}>Chọn
                            trạng thái</option>
                        <option value="active" {{ old('status', $vehicle->status) == 'active' ? 'selected' : '' }}>
                            Hoạt động
                        </option>
                        <option value="maintenance"
                            {{ old('status', $vehicle->status) == 'maintenance' ? 'selected' : '' }}>
                            Bảo dưỡng
                        </option>
                    </select>
                    @error('status')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-start;">
                <button type="submit"
                    style="background-color: #ff5b24; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px;">
                    Lưu thay đổi
                </button>
                <a href="{{ route('admin.vehicles.index') }}"
                    style="display: inline-flex; align-items: center; background-color: #f0f2f5; color: #333; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">
                    Hủy
                </a>
            </div>
        </form>
    </div>

@endsection
