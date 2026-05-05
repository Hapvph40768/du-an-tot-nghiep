@extends('layout.admin.AdminLayout')
@section('content-main')
<div class="container-fluid py-4">
    @if($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm"><ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Chỉnh sửa Lịch trình #{{ $schedule->id }}</h4>
                <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">{{ __('routes') }}</label>
                            <select name="route_id" class="form-select rounded-3">
                                <option value="">-- Chọn tuyến --</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}" {{ old('route_id', $schedule->route_id)==$route->id?'selected':'' }}>
                                        {{ $route->departureLocation->name ?? '' }} → {{ $route->destinationLocation->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">{{ __('time') }} khởi hành</label>
                            <input type="time" name="departure_time" value="{{ old('departure_time', $schedule->departure_time) }}" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check form-switch mt-3">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ old('is_active', $schedule->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold small" for="is_active">Đang hoạt động</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">{{ __('date') }} chạy trong tuần</label>
                            <div class="d-flex flex-wrap gap-2 mt-1">
                                @php $currentDays = old('days_of_week', $schedule->days_of_week ?? []); @endphp
                                @foreach(['Thứ 2'=>'Monday','Thứ 3'=>'Tuesday','Thứ 4'=>'Wednesday','Thứ 5'=>'Thursday','Thứ 6'=>'Friday','Thứ 7'=>'Saturday','Chủ nhật'=>'Sunday'] as $label => $val)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="days_of_week[]" value="{{ $val }}" id="day_{{ $val }}"
                                            {{ in_array($val, $currentDays) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day_{{ $val }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">{{ __('update') }}</button>
                        <a href="{{ route('admin.schedules.index') }}" class="btn btn-light px-4 border">{{ __('cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
