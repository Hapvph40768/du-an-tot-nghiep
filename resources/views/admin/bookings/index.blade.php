@extends('layout.admin')

@section('title', 'Quản lý Đặt vé')

@section('content-main')
<style>
    :root { --primary-color: #ff6b00; --primary-hover: #e65100; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; }
    .custom-table { width: 100%; border-collapse: separate; border-spacing: 0; table-layout: fixed; }
    .custom-table thead th { background-color: #f9fafb; color: #6b7280; font-weight: 600; font-size: 11px; text-transform: uppercase; padding: 16px; border-bottom: 2px solid #edf2f7; }
    .custom-table td { padding: 16px; vertical-align: middle; border-bottom: 1px solid #f3f4f6; font-size: 14px; }
    
    /* Badge trạng thái đơn hàng */
    .badge-booking { padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; display: inline-block; }
    .status-pending { background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5; }
    .status-paid { background: #f0fdf4; color: #15803d; border: 1px solid #dcfce7; }
    .status-cancelled { background: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2; }
    
    .booking-id { font-family: 'Monaco', 'Consolas', monospace; color: #ff6b00; font-weight: 700; }
    .price-total { font-weight: 800; color: #111827; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark m-0">Danh sách Đặt vé</h2>
            <p class="text-muted small mb-0">Theo dõi đơn hàng và trạng thái thanh toán từ khách hàng</p>
        </div>
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="d-flex gap-2 align-items-center">
            <input type="text" name="search" class="form-control form-control-sm rounded-3" placeholder="Mã vé, SĐT, ID..." value="{{ request('search') }}">
            <button class="btn btn-primary btn-sm rounded-3 px-3" type="submit">Tìm</button>
            @if(request('search'))
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-light btn-sm rounded-3 border">Xóa lọc</a>
            @endif
        </form>
        {{-- Có thể thêm nút Xuất Excel báo cáo ở đây --}}
        <button class="btn btn-outline-secondary btn-sm rounded-3 d-none">
            <i class='bx bx-export'></i> Xuất báo cáo
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
            <i class='bx bx-check-circle me-2'></i> {{ session('success') }}
        </div>
    @endif

    <div class="card-box">
        <div class="table-responsive">
            <table class="custom-table w-100">
                <thead>
                    <tr>
                        <th style="width: 12%;">Mã Đơn</th>
                        <th style="width: 20%;">Khách hàng</th>
                        <th style="width: 20%;">Chuyến xe / Tuyến</th>
                        <th style="width: 13%;">Tổng tiền</th>
                        <th style="width: 15%;">Trạng thái</th>
                        <th style="width: 12%;">Ngày đặt</th>
                        <th class="text-end" style="width: 8%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>
                                <span class="booking-id">#BK{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $booking->user->name }}</div>
                                <div class="text-muted small">{{ $booking->user->phone }}</div>
                            </td>
                            <td>
                                <div class="small fw-bold text-truncate">
                                    {{ $booking->trip->route->departureLocation->name }} → {{ $booking->trip->route->destinationLocation->name }}
                                </div>
                                <div class="text-muted small">
                                    {{ \Carbon\Carbon::parse($booking->trip->trip_date)->format('d/m/Y') }} | {{ $booking->trip->departure_time }}
                                </div>
                            </td>
                            <td>
                                <span class="price-total">{{ number_format($booking->total_amount) }}đ</span>
                            </td>
                            <td>
                                <span class="badge-booking status-{{ $booking->status }}">
                                    @if($booking->status == 'pending') <i class='bx bx-time-five'></i> CHỜ TT
                                    @elseif($booking->status == 'paid') <i class='bx bx-check-shield'></i> ĐÃ THANH TOÁN
                                    @else <i class='bx bx-x-circle'></i> ĐÃ HỦY
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="text-muted small">{{ $booking->created_at->format('d/m/Y') }}</div>
                                <div class="text-muted" style="font-size: 10px;">{{ $booking->created_at->format('H:i') }}</div>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-light border shadow-sm">
                                    <i class='bx bx-show-alt text-primary'></i> Xem
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class='bx bx-receipt fs-1 d-block mb-2 opacity-25'></i>
                                Chưa có đơn đặt vé nào trong hệ thống.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
