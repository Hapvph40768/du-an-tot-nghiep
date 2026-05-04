@extends('layout.admin.AdminLayout')

@section('title', 'Xác nhận đơn hàng')
@section('header-title', 'CHECKOUT')
@section('header-subtitle', 'Chọn phương thức thanh toán')

@push('styles')
<style>
    .method-card { transition: all 0.3s ease; border: 2px solid #dee2e6; cursor: pointer; }} .method-card:hover { border-color: #ffb347; }} .method-card.active { border-color: #f97316; background-color: #fff7ed; transform: scale(1.02); box-shadow: 0 10px 15px -3px rgba(249, 115, 22, 0.2); }} .btn-gradient { background: linear-gradient(to right, #fb923c, #ea580c); color: white; transition: all 0.3s; }} .btn-gradient:hover { transform: scale(1.02); box-shadow: 0 10px 15px -3px rgba(234, 88, 12, 0.5); color: white; }}</style>
@endpush

@section('content-main')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                <h3 class="fw-bold text-center mb-4 text-uppercase tracking-wide">{{{ __('confirm') }} đơn hàng</h3>
                
                <div class="bg-light rounded-4 p-4 text-center mb-4 border">
                    <span class="d-block text-muted mb-1 small">{{{ __('debit_amount') }}</span>
                    <div class="fw-bolder" style="font-size: 2.5rem; color: #f97316;">
                        50.000 <span class="fs-4">VNĐ</span>
                    </div>
                </div>

                <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                    @csrf
                    <input type="hidden" name="payment_method" id="selectedMethod" value="vnpay">

                    <p class="fw-bold text-dark mb-3">Chọn phương thức thanh toán</p>
                    <div class="d-flex flex-column gap-3 mb-4">
                        
                        <div class="method-card active rounded-4 p-3 d-flex align-items-center gap-3" onclick="selectMethod('vnpay', this)">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px;">VN</div>
                            <span class="fw-medium">{{{ __('payments') }} VNPAY</span>
                        </div>
                        
                        <div class="method-card rounded-4 p-3 d-flex align-items-center gap-3" onclick="selectMethod('momo', this)">
                            <div class="bg-danger bg-opacity-10 text-danger rounded-3 d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px;">MM</div>
                            <span class="fw-medium">Ví MoMo (Mock)</span>
                        </div>

                        <div class="method-card rounded-4 p-3 d-flex align-items-center gap-3" onclick="selectMethod('bank_transfer', this)">
                            <div class="bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px;">CK</div>
                            <span class="fw-medium">Chuyển khoản Ngân hàng (QR)</span>
                        </div>
                        
                        <div class="method-card rounded-4 p-3 d-flex align-items-center gap-3" onclick="selectMethod('cod', this)">
                            <div class="bg-secondary bg-opacity-10 text-secondary rounded-3 d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px;">COD</div>
                            <span class="fw-medium">{{{ __('payments') }} khi nhận vé</span>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-gradient w-full py-3 fs-5 fw-bold rounded-4 w-100 border-0">
                        THANH TOÁN NGAY
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function selectMethod(method, element) {
        document.getElementById('selectedMethod').value = method;
        document.querySelectorAll('.method-card').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
    }}</script>
@endpush