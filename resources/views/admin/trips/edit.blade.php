@extends('layout.admin.AdminLayout')

@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h3 class="fw-bold mb-4 text-primary">Cập nhật lịch trình: #{{ $trip->id }}</h3>
                <form action="{{ route('admin.trips.update', $trip->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Tuyến đường</label>
                            <select name="route_id" class="form-select rounded-3">
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}" {{ $trip->route_id == $route->id ? 'selected' : '' }}>
                                        {{ $route->departureLocation->name }} → {{ $route->destinationLocation->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Ngày khởi hành</label>
                            <input type="date" name="trip_date" class="form-control rounded-3" value="{{ $trip->trip_date }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Giờ xuất bến</label>
                            <input type="time" name="departure_time" class="form-control rounded-3" value="{{ $trip->departure_time }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Giờ đến</label>
                            <input type="time" name="arrival_time" class="form-control rounded-3" value="{{ $trip->arrival_time }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Xe phụ trách</label>
                            <select name="vehicle_id" class="form-select rounded-3">
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ $trip->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->license_plate }} ({{ $vehicle->type }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Trạng thái chuyến đi</label>
                            <select name="status" class="form-select rounded-3 fw-bold text-primary">
                                <option value="active" {{ $trip->status == 'active' ? 'selected' : '' }}>Đang mở bán</option>
                                <option value="completed" {{ $trip->status == 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                                <option value="cancelled" {{ $trip->status == 'cancelled' ? 'selected' : '' }}>Hủy chuyến</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Điều chỉnh Giá vé</label>
                            <input type="number" name="price" class="form-control rounded-3" value="{{ $trip->price }}">
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-top">
                        <button type="submit" class="btn btn-success px-5 py-2 fw-bold" style="border-radius: 10px;">Lưu cập nhật</button>
                        <a href="{{ route('admin.trips.index') }}" class="btn btn-light px-4 border ms-2" style="border-radius: 10px;">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection