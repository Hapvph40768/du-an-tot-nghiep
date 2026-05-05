@extends('layout.admin.AdminLayout')

@section('title', 'Khóa ghế mới')

@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="fw-bold mb-4">{{ __('seat_locks') }} thủ công</h3>
        <form method="POST" action="{{ route('admin.seat-locks.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Chuyến đi</label>
                <select name="trip_id" class="form-select" required>
                    <option value="">-- Chọn chuyến đi --</option>
                    @foreach($trips as $trip)
                        <option value="{{ $trip->id }}">{{ $trip->route->departureLocation->name ?? '' }} - {{ $trip->route->destinationLocation->name ?? '' }} ({{ $trip->trip_date }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('seats') }}</label>
                <select name="seat_id" class="form-select" required>
                    <option value="">-- Chọn ghế --</option>
                    @foreach($seats as $seat)
                        <option value="{{ $seat->id }}">{{ $seat->seat_code }} ({{ $seat->vehicle->license_plate ?? '' }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('users') }} (tùy chọn)</label>
                <select name="user_id" class="form-select">
                    <option value="">-- Khách vãng lai --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Thời gian khóa (phút)</label>
                <input type="number" name="lock_minutes" class="form-control" value="15" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('seat_locks') }}</button>
            <a href="{{ route('admin.seat-locks.index') }}" class="btn btn-secondary">{{ __('cancel') }}</a>
        </form>
    </div>
</div>
@endsection
