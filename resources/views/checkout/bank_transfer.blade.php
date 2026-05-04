@extends('layout.admin.AdminLayout')

@section('title', 'Quét mã QR')
@section('header-title', 'CHUYỂN KHOẢN')
@section('header-subtitle', 'Thanh toán qua mã QR Ngân hàng')

@section('content-main')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            
            <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 text-center">
                <h3 class="fw-black text-dark text-uppercase mb-1">{{{ __('payments') }} chuyển khoản</h3>
                <p class="text-muted small mb-4">Vui lòng quét mã QR bên dưới bằng app ngân hàng</p>

                <div class="p-3 border rounded-4 bg-light mb-4 shadow-sm" style="border-color: #ffb347 !important;">
                    <img src="https://img.vietqr.io/image/970419-123456789-compact2.jpg?amount={{ $order->amount }}&addInfo={{ $order->order_code }}&accountName=CONG TY BAN VE" 
                         class="img-fluid rounded-3 w-100" alt="QR Code">
                </div>

                <div class="bg-light rounded-4 p-3 text-start mb-4 border">
                    <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                        <span class="text-muted fw-medium">{{{ __('amount') }:</span>
                        <span class="text-dark fw-bold fs-5">{{ number_format($order->amount) }}} VNĐ</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted fw-medium">Nội dung CK:</span>
                        <span class="fw-bold fs-5" style="color: #ff7a18;">{{ $order->order_code }}}</span>
                    </div>
                </div>

                <form action="{{ route('checkout.bank_transfer.upload', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark w-100 py-3 rounded-4 fw-bold fs-6 shadow-sm">
                        TÔI ĐÃ CHUYỂN KHOẢN XONG
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection