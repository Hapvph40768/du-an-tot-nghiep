@extends('layout.admin')

@section('title', 'Chi tiết Giao dịch')

@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="fw-bold mb-4">Chi tiết Giao dịch #{{ $transaction->id }}</h3>
        <div class="row">
            <div class="col-md-6">
                <p><strong>{{ __('users') }}:</strong> {{ $transaction->user->name ?? 'N/A' }}</p>
                <p><strong>{{ __('amount') }}:</strong> {{ number_format($transaction->amount) }} VND</p>
            </div>
            <div class="col-md-6">
                <p><strong>Loại:</strong> {{ $transaction->type }}</p>
                <p><strong>{{ __('status') }}:</strong> <span class="badge bg-primary">{{ $transaction->status }}</span></p>
                <p><strong>{{ __('created_at') }}:</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary mt-3">{{ __('back') }}</a>
    </div>
</div>
@endsection
