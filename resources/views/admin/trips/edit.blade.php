@extends('layout.admin.AdminLayout')

@section('content-main')
    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">

        <form action="{{ route('admin.trips.update', $trip->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">

                <div style="grid-column: span 2;">
                    <label style="margin-bottom: 8px; font-weight: 600;">
                        Tuyến đường <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="route_id" style="width: 100%; padding: 10px; border-radius: 8px;" required>
                        @foreach ($routes as $route)
                            <option value="{{ $route->id }}"
                                {{ old('route_id', $trip->route_id) == $route->id ? 'selected' : '' }}>
                                {{ $route->startLocation->name }} → {{ $route->endLocation->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="margin-bottom: 8px; font-weight: 600;">
                        Xe *
                    </label>
                    <select name="vehicle_id" style="width: 100%; padding: 10px; border-radius: 8px;" required>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}"
                                {{ old('vehicle_id', $trip->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="margin-bottom: 8px; font-weight: 600;">
                        Tài xế *
                    </label>
                    <select name="driver_id" style="width: 100%; padding: 10px; border-radius: 8px;" required>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}"
                                {{ old('driver_id', $trip->driver_id) == $driver->id ? 'selected' : '' }}>
                                {{ $driver->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="margin-bottom: 8px; font-weight: 600;">
                        Ngày đi *
                    </label>
                    <input type="date" name="trip_date" value="{{ old('trip_date', $trip->trip_date) }}"
                        style="width: 100%; padding: 10px; border-radius: 8px;" required>
                </div>

                <div>
                    <label style="margin-bottom: 8px; font-weight: 600;">
                        Giờ đi *
                    </label>
                    <input type="time" name="departure_time"
                        value="{{ old('departure_time', \Carbon\Carbon::parse($trip->departure_time)->format('H:i')) }}"
                        style="width: 100%; padding: 10px; border-radius: 8px;" required>
                </div>

                <div>
                    <label style="margin-bottom: 8px; font-weight: 600;">
                        Giờ đến *
                    </label>
                    <input type="time" name="arrival_time"
                        value="{{ old('arrival_time', \Carbon\Carbon::parse($trip->arrival_time)->format('H:i')) }}"
                        style="width: 100%; padding: 10px; border-radius: 8px;" required>
                </div>

                <div>
                    <label style="margin-bottom: 8px; font-weight: 600;">
                        Giá vé *
                    </label>
                    <input type="number" name="price" value="{{ old('price', $trip->price) }}"
                        style="width: 100%; padding: 10px; border-radius: 8px;" min="0" required>
                </div>

                <div style="grid-column: span 2;">
                    <label style="margin-bottom: 8px; font-weight: 600;">
                        Trạng thái *
                    </label>
                    <select name="status" style="width: 100%; padding: 10px; border-radius: 8px;" required>
                        <option value="active" {{ $trip->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="completed" {{ $trip->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="cancelled" {{ $trip->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>

            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit"
                    style="background-color: #ff5b24; color: white; padding: 10px 24px; border-radius: 8px; font-weight: 600;">
                    Cập nhật
                </button>

                <a href="{{ route('admin.trips.index') }}"
                    style="background-color: #f0f2f5; padding: 10px 24px; border-radius: 8px; text-decoration: none;">
                    Hủy
                </a>
            </div>

        </form>
    </div>
@endsection
