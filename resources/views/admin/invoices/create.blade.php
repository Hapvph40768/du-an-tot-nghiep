@extends('layout.admin')

@section('title', 'Tạo hóa đơn mới')

@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="fw-bold mb-4">Tạo hóa đơn mới</h3>
        <form method="POST" action="{{ route('admin.invoices.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">{{ __('name') }} khách hàng</label>
                <input type="text" name="customer_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mã booking (tùy chọn)</label>
                <input type="text" name="booking_code" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('amount') }}</label>
                <input type="number" name="amount" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phương thức thanh toán</label>
                <input type="text" name="payment_method" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tạo hóa đơn</button>
        </form>
    </div>
</div>
@endsection
