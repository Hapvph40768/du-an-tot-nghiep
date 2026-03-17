@extends('layout.admin.AdminLayout')

@section('title', 'Thêm xe mới')

@section('content-main')

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">

        @if ($errors->any())
            <div
                style="background-color: #fee; border: 1px solid #fcc; color: #c33; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
                <strong>Lỗi:</strong>
                <ul style="margin: 8px 0 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <!-- Biển số xe -->
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Biển số xe <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="text" name="license_plate"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('license_plate') }}" placeholder="Ví dụ: 29A-12345" required autofocus>
                    @error('license_plate')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Loại xe -->
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Loại xe
                    </label>
                    <input type="text" name="type"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('type') }}" placeholder="Ví dụ: Limousine, Xe 16 chỗ...">
                    @error('type')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Số chỗ ngồi -->
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Số chỗ ngồi <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="number" name="total_seats"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="{{ old('total_seats', 16) }}" min="2" max="100" required>
                    @error('total_seats')
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Trạng thái -->
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Trạng thái <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="status"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        required>
                        <option value="" disabled {{ old('status') ? '' : 'selected' }}>Chọn trạng thái</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Bảo dưỡng
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
                    Thêm xe
                </button>
                <a href="{{ route('admin.vehicles.index') }}"
                    style="display: inline-flex; align-items: center; background-color: #f0f2f5; color: #333; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">
                    Hủy
                </a>
            </div>
        </form>
    </div>

@endsection
