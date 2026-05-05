@extends('layout.admin.AdminLayout')

@section('title', 'Lịch sử Giao dịch')

@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="fw-bold mb-4">Lịch sử Giao dịch</h3>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>ID</th>
                        <th>{{ __('users') }}</th>
                        <th>{{ __('amount') }}</th>
                        <th>Loại</th>
                        <th>{{ __('status') }}</th>
                        <th>{{ __('actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->user->name ?? 'N/A' }}</td>
                        <td>{{ number_format($transaction->amount) }} VND</td>
                        <td>{{ $transaction->type }}</td>
                        <td><span class="badge bg-{{ $transaction->status == 'success' ? 'success' : 'warning' }}">{{ $transaction->status }}</span></td>
                        <td>
                            <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-sm btn-outline-primary">{{ __('view') }}</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted">Không có dữ liệu</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $transactions->links() }}</div>
</div>
@endsection
