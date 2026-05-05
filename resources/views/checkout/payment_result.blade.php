@extends('layout.admin.AdminLayout')

@section('title', 'Kết quả giao dịch')
@section('header-title', 'KẾT QUẢ GIAO DỊCH')
@section('header-subtitle', 'Trạng thái thanh toán đơn hàng')

@section('content-main')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 text-center">
                
                @if($status === 'success')
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem;">✓</div>
                    <h3 class="fw-bold text-dark mb-2">{{ __('payments') }} thành công 🎉</h3>
                    <p class="text-muted mb-4">{{ __('orders') }} của bạn đã được thanh toán.</p>
                @elseif($status === 'waiting')
                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem;">⏱</div>
                    <h3 class="fw-bold text-dark mb-2">Đang chờ xác nhận</h3>
                    <p class="text-muted mb-4">Chúng tôi đang kiểm tra giao dịch chuyển khoản của bạn.</p>
                @elseif($status === 'cod')
                    <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem;">📦</div>
                    <h3 class="fw-bold text-dark mb-2">{{ __('bookings') }} thành công</h3>
                    <p class="text-muted mb-4">Vui lòng thanh toán khi nhận vé.</p>
                @else
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; font-size: 2.5rem;">✗</div>
                    <h3 class="fw-bold text-dark mb-2">{{ __('payments') }} thất bại ❌</h3>
                    <p class="text-muted mb-4">Đã có lỗi xảy ra hoặc bạn đã hủy giao dịch.</p>
                @endif

                <div class="bg-light rounded-4 p-3 text-start border mb-4 text-sm">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">{{ __('order_id') }}:</span>
                        <span class="fw-bold">{{ $order->order_code ?? 'N/A' }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">{{ __('amount') }}:</span>
                        <span class="fw-bold" style="color: #ff7a18;">{{ number_format($order->amount ?? 0) }} VNĐ</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Phương thức:</span>
                        <span class="fw-bold text-uppercase">{{ $order->payment_method ?? 'N/A' }}</span>
                    </div>
                </div>

                <a href="{{ route('admin.dashboard') }}" class="btn btn-light border text-dark fw-bold py-3 rounded-4 w-100 shadow-sm hover-bg-gray">
                    Quay lại bảng điều khiển
                </a>
            </div>

        </div>
    </div>
</div>
@endsection