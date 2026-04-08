@extends('layout.admin.AdminLayout')

@section('content-main')
<h3 class="mb-4">Chi tiết Booking</h3>

<div class="card w-50">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $booking->id }}</td>
            </tr>
            <tr>
                <th>Khách hàng</th>
                <td>{{ $booking->user->name }}</td>
            </tr>
            <tr>
                <th>Chuyến xe</th>
                <td>#{{ $booking->trip->id }}</td>
            </tr>
            <tr>
                <th>Điểm đón</th>
                <td>{{ $booking->pickupPoint->name }}</td>
            </tr>
            <tr>
                <th>Tổng tiền</th>
                <td>{{ $booking->total_amount }}</td>
            </tr>
            <tr>
                <th>Trạng thái</th>
                <td>
                    <span class="badge bg-{{ $booking->status == 'paid' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'danger') }}">
                        {{ $booking->status }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Ngày tạo</th>
                <td>{{ $booking->created_at }}</td>
            </tr>
        </table>

        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Quay lại</a>
        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning">Sửa</a>
    </div>
</div>
@endsection