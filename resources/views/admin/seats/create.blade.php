@extends('layout.admin.AdminLayout')

@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Thêm ghế phụ/ghế súp</h4>
                
                <form action="{{ route('admin.seats.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Chọn xe</label>
                        <select name="vehicle_id" class="form-select rounded-3 @error('vehicle_id') is-invalid @enderror">
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->license_plate }} - {{ $vehicle->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small">Mã số ghế</label>
                        <input type="text" name="seat_number" class="form-control rounded-3 @error('seat_number') is-invalid @enderror" 
                               placeholder="Ví dụ: S01, S02..." value="{{ old('seat_number') }}">
                        <div class="form-text mt-2 small text-muted italic">Mã ghế không được trùng lặp trên cùng một xe.</div>
                    </div>

                    <div class="pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background: #ff6b00; border:none; border-radius: 10px;">{{ __('save') }} thông tin</button>
                        <a href="{{ route('admin.seats.index') }}" class="btn btn-light px-4 border ms-2">{{ __('cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection