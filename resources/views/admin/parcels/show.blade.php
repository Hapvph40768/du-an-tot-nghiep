@extends('layout.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Chi Tiết Ký Gửi #{{ $parcel->id }}</h6>
                    <a href="{{ route('admin.parcels.index') }}" class="btn btn-secondary btn-sm mb-0">Quay lại</a>
                </div>
                <div class="card-body px-4 pt-4 pb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Người Gửi</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Tên:</strong> {{ $parcel->sender_name }}</li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Số điện thoại:</strong> {{ $parcel->sender_phone }}</li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Địa chỉ:</strong> {{ $parcel->sender_address }}</li>
                            </ul>

                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Người Nhận</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Tên:</strong> {{ $parcel->receiver_name }}</li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Số điện thoại:</strong> {{ $parcel->receiver_phone }}</li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Địa chỉ:</strong> {{ $parcel->receiver_address }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Thông Tin Gói Hàng</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Tuyến đường:</strong> {{ $parcel->route->departureLocation->name ?? '...' }} → {{ $parcel->route->destinationLocation->name ?? '...' }}</li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Chuyến xe:</strong> 
                                    @if($parcel->trip)
                                        Chuyến {{ \Carbon\Carbon::parse($parcel->trip->departure_time)->format('H:i') }} - Ngày {{ \Carbon\Carbon::parse($parcel->trip->trip_date)->format('d/m/Y') }}<br>
                                        <small class="text-muted">Xe: {{ $parcel->trip->vehicle->license_plate ?? 'N/A' }} | Lái xe: {{ $parcel->trip->driver->name ?? 'N/A' }} ({{ $parcel->trip->driver->phone ?? '' }})</small>
                                    @else
                                        <span class="text-muted fst-italic">Chưa phân công xe</span>
                                    @endif
                                </li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Khối lượng:</strong> {{ $parcel->weight }} kg</li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Giá cước:</strong> {{ number_format($parcel->price) }} ₫</li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Mô tả:</strong> {{ $parcel->description ?: 'Không có mô tả' }}</li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Ngày tạo:</strong> {{ $parcel->created_at->format('d/m/Y H:i') }}</li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Trạng thái:</strong> 
                                    @if($parcel->status == 'pending')
                                        <span class="badge bg-warning">Chờ xử lý</span>
                                    @elseif($parcel->status == 'shipping')
                                        <span class="badge bg-info">Đang giao</span>
                                    @elseif($parcel->status == 'completed')
                                        <span class="badge bg-success">Đã giao</span>
                                    @else
                                        <span class="badge bg-danger">Đã hủy</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
