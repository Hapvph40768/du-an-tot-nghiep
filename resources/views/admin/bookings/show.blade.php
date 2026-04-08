@extends('layout.admin.AdminLayout')

@section('title', 'Chi tiết Đặt vé')

@section('content-main')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết đặt vé #{{ $booking->id }}</h1>
        <div>
            <a href="{{ route('admin.bookings.export', $booking->id) }}" target="_blank" class="btn btn-info btn-sm text-white md-2">
                <i class="fas fa-print"></i> In vé
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin chung</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Khách hàng</h5>
                            <p><strong>Họ tên:</strong> {{ $booking->user->name ?? 'Khách vãng lai' }}</p>
                            <p><strong>Email:</strong> {{ $booking->user->email ?? 'N/A' }}</p>
                            <p><strong>Số điện thoại:</strong> {{ $booking->user->phone ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Thông tin chuyến đi</h5>
                            <p><strong>Tuyến:</strong> 
                                {{ $booking->trip->route->startLocation->name }} 
                                <i class="fas fa-long-arrow-alt-right"></i> 
                                {{ $booking->trip->route->endLocation->name }}
                            </p>
                            <p><strong>Khởi hành:</strong> {{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('H:i d/m/Y') }}</p>
                            <p><strong>Số điện thoại xe:</strong> <a href="tel:{{ $booking->trip->vehicle->phone_vehicles ?? '' }}" class="text-primary">{{ $booking->trip->vehicle->phone_vehicles ?? 'Chưa có' }}</a></p>
                            <p><strong>Điểm đón:</strong> {{ $booking->pickupPoint->name ?? 'Tại văn phòng' }}</p>
                        </div>
                    </div>

                    <hr>

                    <h5>Danh sách vé / Chỗ ngồi</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã vé</th>
                                    <th>Số ghế</th>
                                    <th>Giá vé</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->ticket_code }}</td>
                                    <td><span class="badge bg-info text-dark">{{ $ticket->seat->seat_number }}</span></td>
                                    <td>{{ number_format($ticket->trip->price) }}đ</td>
                                </tr>@endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-end">Tổng cộng:</th>
                                    <th class="text-danger">{{ number_format($booking->total_amount) }}đ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Trạng thái & Thanh toán</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Trạng thái hiện tại:</label>
                        <br>
                        @if($booking->status == 'pending')
                            <span class="badge bg-warning text-dark">Chờ thanh toán</span>
                        @elseif($booking->status == 'paid')
                            <span class="badge bg-success text-white">Đã thanh toán</span>
                        @else
                            <span class="badge bg-danger text-white">Đã hủy</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Phương thức thanh toán:</label>
                        <p>{{ strtoupper($booking->payment->payment_method ?? 'Chưa xác định') }}</p>
                    </div>

                    <hr>

                    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="status" class="form-label font-weight-bold">Cập nhật trạng thái:</label>
                            <select name="status" id="status" class="form-select form-control">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Chờ thanh toán</option>
                                <option value="paid" {{ $booking->status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Hủy đơn hàng</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Cập nhật đơn hàng</button>
                    </form>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Phương tiện & Lái xe</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Biển số xe:</label>
                        <p>{{ $booking->trip->vehicle->license_plate ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Lái xe:</label>
                        <p>{{ $booking->trip->driver->name ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Số điện thoại lái xe:</label>
                        <p><a href="tel:{{ $booking->trip->driver->phone ?? '' }}" class="text-primary font-weight-bold">{{ $booking->trip->driver->phone ?? 'N/A' }}</a></p>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-body"><p class="small text-muted">Ngày đặt: {{ $booking->created_at->format('d/m/Y H:i:s') }}</p>
                    <p class="small text-muted">Cập nhật cuối: {{ $booking->updated_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection