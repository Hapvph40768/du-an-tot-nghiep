@extends('layout.customer.CustomerLayout')

@section('content-main')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h3 class="fw-bold text-center mb-4">Bạn đang gặp vấn đề gì?</h3>
                    
                    <form action="{{ route('customer.support.store') }}" method="POST">
                        @csrf
                        
                        {{ -- Chọn loại vấn đề bằng Card -- }}<label class="form-label fw-bold mb-3">Vui lòng chọn danh mục hỗ trợ:</label>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="type" id="type_payment" value="payment" required onclick="updateDesc('Thanh toán')">
                                <label class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex flex-column align-items-center" for="type_payment">
                                    <i class='bx bx-credit-card fs-1 mb-2'></i>
                                    <span>{{ __('payments') }}</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="type" id="type_ticket" value="ticket" onclick="updateDesc('Vé xe')">
                                <label class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex flex-column align-items-center" for="type_ticket">
                                    <i class='bx bx-barcode-reader fs-1 mb-2'></i>
                                    <span>Đổi/Hủy vé</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="type" id="type_complaint" value="complaint" onclick="updateDesc('Khiếu nại')">
                                <label class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex flex-column align-items-center" for="type_complaint">
                                    <i class='bx bx-angry fs-1 mb-2'></i>
                                    <span>Khiếu nại</span>
                                </label>
                            </div>
                        </div>

                        {{ -- Chọn mã đặt vé (nếu có) -- }}<div class="mb-4">
                            <label class="form-label fw-bold">Chuyến đi liên quan (không bắt buộc):</label>
                            <select name="booking_id" class="form-select rounded-3">
                                <option value="">-- Chọn chuyến đi --</option>
                                {{ -- Giả sử bạn truyền biến $bookings từ controller qua -- }} @isset($bookings)
                                    @foreach($bookings as $booking)
                                        <option value="{{ $booking->id }}">Mã #{{ $booking->id }} - {{ $booking->trip->route->departure }} đi {{ $booking->trip->route->destination }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>

                        {{ -- Nội dung mô tả -- }}<div class="mb-4">
                            <label class="form-label fw-bold">{{ __('description') }} chi tiết vấn đề:</label>
                            <textarea name="description" id="description" class="form-control rounded-3" rows="5" placeholder="Hãy mô tả vấn đề của bạn tại đây..." required></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2 fw-bold">{{ __('submit') }} yêu cầu ngay</button>
                            <a href="{{ route('customer.support.index') }}" class="btn btn-light">{{ __('cancel') }} bỏ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateDesc(type) {
        let desc = document.getElementById('description');
        if(type === 'Thanh toán') {
            desc.value = "Tôi gặp vấn đề khi thanh toán cho đơn hàng. Tiền đã bị trừ nhưng vé chưa xác nhận...";
        }} else if(type === 'Vé xe') {
            desc.value = "Tôi muốn đổi ngày đi hoặc hủy vé cho chuyến xe sắp tới. Lý do là...";
        }} else if(type === 'Khiếu nại') {
            desc.value = "Tôi không hài lòng về chất lượng phục vụ/thái độ nhân viên tại nhà xe...";
        }} desc.focus();
    }}</script>

<style>
    .btn-check:checked + .btn-outline-primary {
        background-color: #0d6efd;
        color: white;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }}</style>
@endsection