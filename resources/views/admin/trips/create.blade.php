@extends('layout.admin.AdminLayout')

@section('content-main')
    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">

        <form action="{{ route('admin.trips.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">

                <div style="grid-column: span 2;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Tuyến đường <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="route_id"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px;" required>
                        <option value="">-- Chọn tuyến đường --</option>
                        @foreach ($routes as $route)
                            <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                                {{ $route->startLocation->name }} → {{ $route->endLocation->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('route_id')
                        <div style="color: #c33; font-size: 12px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Xe <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="vehicle_id"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                        <option value="">-- Chọn xe --</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Tài xế <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="driver_id" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;"
                        required>
                        <option value="">-- Chọn tài xế --</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                {{ $driver->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Ngày đi <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="date" name="trip_date" value="{{ old('trip_date') }}"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Giờ đi <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="time" name="departure_time" value="{{ old('departure_time') }}"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Giờ đến <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="time" name="arrival_time" value="{{ old('arrival_time') }}"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Giá vé (VNĐ) <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="number" name="price" value="{{ old('price') }}"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" min="0"
                        required>
                </div>

                <div style="grid-column: span 2;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                        Trạng thái <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="status" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;"
                        required>
                        <option value="active">Hoạt động</option>
                        <option value="completed">Hoàn thành</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>

            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit"
                    style="background-color: #ff5b24; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600;">
                    Thêm chuyến đi
                </button>

                <a href="{{ route('admin.trips.index') }}"
                    style="display: inline-flex; align-items: center; background-color: #f0f2f5; color: #333; padding: 10px 24px; border-radius: 8px; font-weight: 600; text-decoration: none;">
                    Hủy
                </a>
            </div>

        </form>
    </div>
@endsection
