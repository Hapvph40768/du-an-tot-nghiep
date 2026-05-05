@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Hóa đơn')

@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Quản lý Hóa đơn</h3>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>Mã hóa đơn</th>
                        <th>Khách hàng</th>
                        <th>{{ __('total') }} tiền</th>
                        <th>{{ __('status') }}</th>
                        <th>{{ __('actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->invoice_code }}</td>
                        <td>{{ $invoice->customer_name }}</td>
                        <td>{{ number_format($invoice->amount) }} VNĐ</td>
                        <td><span class="badge bg-primary">{{ $invoice->status }}</span></td>
                        <td><a href="{{ route('admin.invoices.show', $invoice) }}" class="btn btn-sm btn-outline-primary">{{ __('view') }}</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted">Không có dữ liệu</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $invoices->links() }}</div>
</div>
@endsection
