@extends('layout.admin.AdminLayout')

@section('content-main')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Chỉnh sửa thông tin ghế</h4>
                
                <form action="{{ route('admin.seats.update', $seat->id) }}" method="POST">
                    @csrf @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Thuộc xe</label>
                        <select name="vehicle_id" class="form-select rounded-3">
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ $seat->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->license_plate }} ({{ $vehicle->type }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small">Mã số ghế</label>
                        <input type="text" name="seat_number" value="{{ old('seat_number', $seat->seat_number) }}" class="form-control rounded-3">
                    </div>

                    <div class="pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background: #ff6b00; border:none; border-radius: 10px;">Cập nhật</button>
                        <a href="{{ route('admin.seats.index', ['vehicle_id' => $seat->vehicle_id]) }}" class="btn btn-light px-4 border ms-2">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection