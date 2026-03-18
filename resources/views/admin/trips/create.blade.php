@extends('layout.admin.AdminLayout')

@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h3 class="fw-bold mb-4">Lên lịch Chuyến xe mới</h3>
                <form action="{{ route('admin.trips.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Chọn Tuyến đường</label>
                            <select name="route_id" class="form-select rounded-3 shadow-sm">
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}">{{ $route->departureLocation->name }} → {{ $route->destinationLocation->name }} ({{ $route->distance_km }}km)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Ngày khởi hành</label>
                            <input type="date" name="trip_date" class="form-control rounded-3" >
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Giờ xuất bến</label>
                            <input type="time" name="departure_time" class="form-control rounded-3" >
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Giờ đến dự kiến</label>
                            <input type="time" name="arrival_time" class="form-control rounded-3" >
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Chọn Xe</label>
                            <select name="vehicle_id" class="form-select rounded-3">
                                <option value="">-- Chọn điểm xe --</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->license_plate }} - {{ $vehicle->type }} ({{ $vehicle->total_seats }} ghế  )</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tài xế phụ trách</label>
                            <select name="driver_id" class="form-select rounded-3">
                                <option value="">-- Chọn tài xế --</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }} (SĐT: {{ $driver->phone }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Giá vé (VNĐ)</label>
                            <div class="input-group">
                                <input type="number" name="price" class="form-control rounded-3" placeholder="Ví dụ: 250000" required>
                                <span class="input-group-text">đ</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Trạng thái ban đầu</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="active">Mở bán (Active)</option>
                                <option value="cancelled">Hủy chuyến</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold" style="background: #ff6b00; border:none; border-radius: 10px;">Xác nhận tạo chuyến</button>
                        <a href="{{ route('admin.trips.index') }}" class="btn btn-light px-4 border ms-2" style="border-radius: 10px;">Hủy bỏ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection