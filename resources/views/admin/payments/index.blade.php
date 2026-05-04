@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Thanh toán')

@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="fw-bold mb-4">Quản lý Thanh toán</h3>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>Mã thanh toán</th>
                        <th>Booking</th>
                        <th>{{{ __('amount') }}</th>
                        <th>Phương thức</th>
                        <th>{{{ __('status') }}</th>
                        <th>{{{ __('actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}}</td>
                        <td>{{ $payment->booking->booking_code ?? 'N/A' }}}</td>
                        <td>{{ number_format($payment->amount) }}} VND</td>
                        <td>{{ $payment->payment_method }}}</td>
                        <td><span class="badge bg-{{ $payment->status == 'success' ? 'success' : 'warning' }}">{{ $payment->status }}}</span></td>
                        <td>
                            <form method="POST" action="{{ route('admin.payments.update', $payment) }}">
                                @csrf @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                    <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="success" {{ $payment->status == 'success' ? 'selected' : '' }}>Success</option>
                                    <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted">Không có dữ liệu</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $payments->links() }}}</div>
</div>
@endsection
