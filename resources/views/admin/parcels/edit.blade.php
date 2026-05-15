@extends('layout.admin')
@section('content-main')
<div class="container-fluid py-4">
    @if($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm"><ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Chỉnh sửa Đơn ký gửi #{{ $parcel->id }}</h4>
                <form action="{{ route('admin.parcels.update', $parcel->id) }}" method="POST">
                    @csrf @method('PUT')
                    @if($parcel->status === 'cancelled')
                        <div class="alert alert-warning mb-4 rounded-3 border-0 shadow-sm">
                            <i class="bx bx-error-circle me-1"></i> Đơn ký gửi này đã bị huỷ nên không thể chỉnh sửa thông tin.
                        </div>
                    @endif
                    <fieldset @if($parcel->status === 'cancelled') disabled @endif>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Họ tên người gửi</label>
                            <input type="text" name="sender_name" value="{{ old('sender_name', $parcel->sender_name) }}" class="form-control rounded-3 @error('sender_name') is-invalid @enderror">
                            @error('sender_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Số điện thoại người gửi</label>
                            <input type="text" name="sender_phone" value="{{ old('sender_phone', $parcel->sender_phone) }}" class="form-control rounded-3 @error('sender_phone') is-invalid @enderror">
                            @error('sender_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Họ tên người nhận</label>
                            <input type="text" name="receiver_name" value="{{ old('receiver_name', $parcel->receiver_name) }}" class="form-control rounded-3 @error('receiver_name') is-invalid @enderror">
                            @error('receiver_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Số điện thoại người nhận</label>
                            <input type="text" name="receiver_phone" value="{{ old('receiver_phone', $parcel->receiver_phone) }}" class="form-control rounded-3 @error('receiver_phone') is-invalid @enderror">
                            @error('receiver_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold small">Tuyến đường</label>
                            <select name="route_id" id="route_id" class="form-select rounded-3 @error('route_id') is-invalid @enderror">
                                <option value="">-- Chọn tuyến đường --</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}" {{ old('route_id', $parcel->route_id)==$route->id?'selected':'' }}>
                                        {{ $route->departureLocation->name ?? '' }} → {{ $route->destinationLocation->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @error('route_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Điểm nhận hàng (Bến gửi)</label>
                            <select name="pickup_point_id" id="pickup_point_id" class="form-select rounded-3 @error('pickup_point_id') is-invalid @enderror" data-selected="{{ old('pickup_point_id', $parcel->pickup_point_id) }}" disabled>
                                <option value="">-- Chọn tuyến đường trước --</option>
                            </select>
                            @error('pickup_point_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Điểm trả hàng (Bến nhận)</label>
                            <select name="dropoff_point_id" id="dropoff_point_id" class="form-select rounded-3 @error('dropoff_point_id') is-invalid @enderror" data-selected="{{ old('dropoff_point_id', $parcel->dropoff_point_id) }}" disabled>
                                <option value="">-- Chọn tuyến đường trước --</option>
                            </select>
                            @error('dropoff_point_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold small">Mô tả hàng hoá</label>
                            <textarea name="description" rows="2" class="form-control rounded-3">{{ old('description', $parcel->description) }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Trọng lượng (kg)</label>
                            <input type="number" step="0.01" name="weight" id="weight_input" value="{{ old('weight', $parcel->weight) }}" class="form-control rounded-3 @error('weight') is-invalid @enderror">
                            @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Cước phí (VNĐ) <span class="text-muted fw-normal" style="font-size: 11px;">(Tự động tính)</span></label>
                            <input type="number" name="price" id="price_input" value="{{ old('price', $parcel->price) }}" class="form-control rounded-3 bg-light @error('price') is-invalid @enderror">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Trạng thái</label>
                            <select name="status" class="form-select rounded-3">
                                @foreach(['pending'=>'Chờ xử lý','shipping'=>'Đang vận chuyển','completed'=>'Hoàn thành','cancelled'=>'Đã huỷ'] as $val => $label)
                                    <option value="{{ $val }}" {{ old('status', $parcel->status)==$val?'selected':'' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mt-4 pt-3 border-top">
                            <label class="form-label fw-bold small text-primary"><i class="bx bx-bus"></i> Phân công chuyến xe (Tuỳ chọn)</label>
                            <select name="trip_id" class="form-select rounded-3">
                                <option value="">-- Chưa phân công --</option>
                                @if(isset($trips) && $trips->count() > 0)
                                    @foreach($trips as $trip)
                                        <option value="{{ $trip->id }}" {{ old('trip_id', $parcel->trip_id) == $trip->id ? 'selected' : '' }}>
                                            Chuyến {{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }} - Ngày {{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }} 
                                            (Xe: {{ $trip->vehicle->license_plate ?? 'N/A' }} | Lái xe: {{ $trip->driver->name ?? 'N/A' }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    </fieldset>
                    <div class="mt-4 pt-3 border-top">
                        @if($parcel->status !== 'cancelled')
                            <button type="submit" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">Lưu cập nhật</button>
                        @endif
                        <a href="{{ route('admin.parcels.index') }}" class="btn btn-light px-4 border">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const routeSelect = document.getElementById('route_id');
        const pickupSelect = document.getElementById('pickup_point_id');
        const dropoffSelect = document.getElementById('dropoff_point_id');
        const weightInput = document.getElementById('weight_input');
        const priceInput = document.getElementById('price_input');

        // Auto calculate price based on weight
        weightInput.addEventListener('input', function() {
            let weight = parseFloat(this.value);
            if (!isNaN(weight) && weight > 0) {
                let price = weight * 10000;
                priceInput.value = price < 20000 ? 20000 : price;
            } else {
                priceInput.value = '';
            }
        });

        function loadPoints(routeId) {
            if (!routeId) {
                pickupSelect.innerHTML = '<option value="">-- Chọn tuyến đường trước --</option>';
                dropoffSelect.innerHTML = '<option value="">-- Chọn tuyến đường trước --</option>';
                pickupSelect.disabled = true;
                dropoffSelect.disabled = true;
                return;
            }

            pickupSelect.innerHTML = '<option value="">Đang tải...</option>';
            dropoffSelect.innerHTML = '<option value="">Đang tải...</option>';
            pickupSelect.disabled = true;
            dropoffSelect.disabled = true;

            fetch(`{{ url('admin/trips/get-points') }}/${routeId}`)
                .then(res => res.json())
                .then(data => {
                    let oldPickup = pickupSelect.getAttribute('data-selected');
                    let oldDropoff = dropoffSelect.getAttribute('data-selected');

                    // Load pickup points
                    pickupSelect.innerHTML = '<option value="">-- Chọn điểm nhận hàng --</option>';
                    if (data.pickup_points.length > 0) {
                        data.pickup_points.forEach(point => {
                            let timeText = point.time_from_departure ? ` (+${point.time_from_departure}p)` : '';
                            let selected = (oldPickup == point.id) ? 'selected' : '';
                            pickupSelect.innerHTML += `<option value="${point.id}" ${selected}>${point.name} ${timeText} - ${point.address}</option>`;
                        });
                        pickupSelect.disabled = false;
                    } else {
                        pickupSelect.innerHTML = '<option value="">Không có điểm nhận hàng cho tuyến này</option>';
                    }

                    // Load dropoff points
                    dropoffSelect.innerHTML = '<option value="">-- Chọn điểm trả hàng --</option>';
                    if (data.dropoff_points.length > 0) {
                        data.dropoff_points.forEach(point => {
                            let timeText = point.time_from_departure ? ` (+${point.time_from_departure}p)` : '';
                            let selected = (oldDropoff == point.id) ? 'selected' : '';
                            dropoffSelect.innerHTML += `<option value="${point.id}" ${selected}>${point.name} ${timeText} - ${point.address}</option>`;
                        });
                        dropoffSelect.disabled = false;
                    } else {
                        dropoffSelect.innerHTML = '<option value="">Không có điểm trả hàng cho tuyến này</option>';
                    }
                })
                .catch(err => {
                    console.error('Error fetching points:', err);
                    pickupSelect.innerHTML = '<option value="">Lỗi tải dữ liệu</option>';
                    dropoffSelect.innerHTML = '<option value="">Lỗi tải dữ liệu</option>';
                });
        }

        routeSelect.addEventListener('change', function () {
            // When user manually changes route, reset selected attributes
            pickupSelect.setAttribute('data-selected', '');
            dropoffSelect.setAttribute('data-selected', '');
            loadPoints(this.value);
            
            // Also might need to fetch available trips for this route, but we skip it here since the previous code didn't use AJAX for trips, it passed trips directly in PHP.
            // If they change route, they should probably save and let page reload.
        });

        if (routeSelect.value) {
            loadPoints(routeSelect.value);
        }
    });
</script>
@endpush
