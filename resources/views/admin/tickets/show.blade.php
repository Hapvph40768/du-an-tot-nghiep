@extends('layout.admin.AdminLayout')

@section('title', 'Chi tiết Vé')

@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="fw-bold mb-4">Chi tiết Vé #{{ $ticket->id }}</h3>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Khách hàng:</strong> {{ $ticket->booking->user->name ?? 'N/A' }}</p>
                <p><strong>Chuyến đi:</strong> {{ $ticket->trip->route->departureLocation->name ?? '' }} - {{ $ticket->trip->route->destinationLocation->name ?? '' }}</p>
                <p><strong>{{ __('seats') }}:</strong> {{ $ticket->seat->seat_code ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>{{ __('status') }}:</strong> {{ $ticket->status }}</p>
                <p><strong>{{ __('created_at') }}:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}" class="mt-3">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">{{ __('update') }} trạng thái</label>
                <select name="status" class="form-select">
                    <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $ticket->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $ticket->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="used" {{ $ticket->status == 'used' ? 'selected' : '' }}>Used</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('update') }}</button>
            <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">{{ __('back') }}</a>
        </form>
    </div>
</div>
@endsection
