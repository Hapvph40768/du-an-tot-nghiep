@extends('layout.admin')
@section('content-main')
<div class="container-fluid py-4">
    @if($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm"><ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Thêm Lịch trình mới</h4>
                <form action="{{ route('admin.schedules.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">{{ __('routes') }}</label>
                            <select name="route_id" class="form-select rounded-3 @error('route_id') is-invalid @enderror">
                                <option value="">-- Chọn tuyến --</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}" {{ old('route_id')==$route->id?'selected':'' }}>
                                        {{ $route->departureLocation->name ?? '' }} → {{ $route->destinationLocation->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @error('route_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">{{ __('time') }} khởi hành</label>
                            <input type="time" name="departure_time" value="{{ old('departure_time') }}" class="form-control rounded-3 @error('departure_time') is-invalid @enderror">
                            @error('departure_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check form-switch mt-3">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold small" for="is_active">Đang hoạt động</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">{{ __('date') }} chạy trong tuần</label>
                            <div class="d-flex flex-wrap gap-2 mt-1">
                                @foreach(['Thứ 2','Thứ 3','Thứ 4','Thứ 5','Thứ 6','Thứ 7','Chủ nhật'] as $day)
                                    @php $val = ['Thứ 2'=>'Monday','Thứ 3'=>'Tuesday','Thứ 4'=>'Wednesday','Thứ 5'=>'Thursday','Thứ 6'=>'Friday','Thứ 7'=>'Saturday','Chủ nhật'=>'Sunday'][$day]; @endphp
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="days_of_week[]" value="{{ $val }}" id="day_{{ $val }}"
                                            {{ in_array($val, old('days_of_week', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day_{{ $val }}">{{ $day }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('days_of_week')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">{{ __('save') }} lịch trình</button>
                        <a href="{{ route('admin.schedules.index') }}" class="btn btn-light px-4 border">{{ __('cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
