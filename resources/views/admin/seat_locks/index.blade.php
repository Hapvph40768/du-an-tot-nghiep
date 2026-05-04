@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Khóa ghế')

@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Danh sách Ghế đang khóa</h3>
            <a href="{{ route('admin.seat-locks.create') }}" class="btn btn-primary">+ Khóa ghế mới</a>
        </div>

        <form method="GET" class="mb-3">
            <select name="trip_id" class="form-select w-auto d-inline" onchange="this.form.submit()">
                <option value="">-- Chọn chuyến đi --</option>
                @foreach($trips as $trip)
                    <option value="{{ $trip->id }}" {{ request('trip_id') == $trip->id ? 'selected' : '' }}>
                        {{ $trip->route->departureLocation->name ?? '' }}} - {{ $trip->route->destinationLocation->name ?? '' }}} ({{ $trip->trip_date }})
                    </option>
                @endforeach
            </select>
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>ID</th>
                        <th>Chuyến đi</th>
                        <th>{{{ __('seats') }}</th>
                        <th>Người khóa</th>
                        <th>Hết hạn</th>
                        <th>{{{ __('actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($seatLocks as $lock)
                    <tr>
                        <td>{{ $lock->id }}}</td>
                        <td>{{ $lock->trip->route->departureLocation->name ?? '' }}} - {{ $lock->trip->route->destinationLocation->name ?? '' }}}</td>
                        <td>{{ $lock->seat->seat_code ?? 'N/A' }}}</td>
                        <td>{{ $lock->user->name ?? 'Khách vãng lai' }}}</td>
                        <td>{{ $lock->locked_until->format('H:i d/m') }}}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.seat-locks.destroy', $lock) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Mở khóa ghế này?')">Mở khóa</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted">Không có ghế nào đang bị khóa</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $seatLocks->links() }}}</div>
</div>
@endsection
