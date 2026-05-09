@extends('layout.admin')

@section('title', 'Chi tiết Hóa đơn')

@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="fw-bold">Chi tiết Hóa đơn: {{ $invoice->invoice_code }}</h3>
        <p>Khách hàng: {{ $invoice->customer_name }}</p>
        <p>Tổng tiền: {{ number_format($invoice->amount) }} VNĐ</p>
        <p>Trạng thái: {{ $invoice->status }}</p>
        <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">{{ __('back') }}</a>
    </div>
</div>
@endsection
