@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Vé')

@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="fw-bold mb-4">Quản lý Vé</h3>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>Mã vé</th>
                        <th>Khách hàng</th>
                        <th>Chuyến đi</th>
                        <th>{{{ __('seats') }}</th>
                        <th>{{{ __('status') }}</th>
                        <th>{{{ __('actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}}</td>
                        <td>{{ $ticket->booking->user->name ?? 'N/A' }}}</td>
                        <td>{{ $ticket->trip->route->departureLocation->name ?? '' }}} - {{ $ticket->trip->route->destinationLocation->name ?? '' }}}</td>
                        <td>{{ $ticket->seat->seat_code ?? 'N/A' }}}</td>
                        <td><span class="badge bg-primary">{{ $ticket->status }}}</span></td>
                        <td>
                            <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary">{{{ __('view') }}</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted">Không có dữ liệu</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $tickets->links() }}}</div>
</div>
@endsection
