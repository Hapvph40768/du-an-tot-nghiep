@extends('layout.admin')
@section('content-main')
<div class="container-fluid py-4">
    @if($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm"><ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Thêm Đơn ký gửi mới</h4>
                <form action="{{ route('admin.parcels.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Họ tên người gửi</label>
                            <input type="text" name="sender_name" value="{{ old('sender_name') }}" class="form-control rounded-3 @error('sender_name') is-invalid @enderror">
                            @error('sender_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Số điện thoại người gửi</label>
                            <input type="text" name="sender_phone" value="{{ old('sender_phone') }}" class="form-control rounded-3 @error('sender_phone') is-invalid @enderror">
                            @error('sender_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Họ tên người nhận</label>
                            <input type="text" name="receiver_name" value="{{ old('receiver_name') }}" class="form-control rounded-3 @error('receiver_name') is-invalid @enderror">
                            @error('receiver_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Số điện thoại người nhận</label>
                            <input type="text" name="receiver_phone" value="{{ old('receiver_phone') }}" class="form-control rounded-3 @error('receiver_phone') is-invalid @enderror">
                            @error('receiver_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold small">Tuyến đường</label>
                            <select name="route_id" id="route_id" class="form-select rounded-3 @error('route_id') is-invalid @enderror">
                                <option value="">-- Chọn tuyến đường --</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}" {{ old('route_id')==$route->id?'selected':'' }}>
                                        {{ $route->departureLocation->name ?? '' }} → {{ $route->destinationLocation->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @error('route_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Điểm nhận hàng (Bến gửi)</label>
                            <select name="pickup_point_id" id="pickup_point_id" class="form-select rounded-3 @error('pickup_point_id') is-invalid @enderror" disabled>
                                <option value="">-- Chọn tuyến đường trước --</option>
                            </select>
                            @error('pickup_point_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Điểm trả hàng (Bến nhận)</label>
                            <select name="dropoff_point_id" id="dropoff_point_id" class="form-select rounded-3 @error('dropoff_point_id') is-invalid @enderror" disabled>
                                <option value="">-- Chọn tuyến đường trước --</option>
                            </select>
                            @error('dropoff_point_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold small">Mô tả hàng hoá</label>
                            <textarea name="description" rows="2" class="form-control rounded-3" placeholder="Nhập mô tả hàng hoá...">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Trọng lượng (kg)</label>
                            <input type="number" step="0.01" name="weight" id="weight_input" value="{{ old('weight') }}" class="form-control rounded-3 @error('weight') is-invalid @enderror">
                            @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Cước phí (VNĐ) <span class="text-muted fw-normal" style="font-size: 11px;">(Tự động tính)</span></label>
                            <input type="number" name="price" id="price_input" value="{{ old('price') }}" class="form-control rounded-3 bg-light @error('price') is-invalid @enderror">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Trạng thái</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="pending" {{ old('status')=='pending'?'selected':'' }}>Chờ xử lý</option>
                                <option value="shipping" {{ old('status')=='shipping'?'selected':'' }}>Đang vận chuyển</option>
                                <option value="completed" {{ old('status')=='completed'?'selected':'' }}>Hoàn thành</option>
                                <option value="cancelled" {{ old('status')=='cancelled'?'selected':'' }}>Đã huỷ</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">Lưu đơn ký gửi</button>
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
                    // Load pickup points
                    pickupSelect.innerHTML = '<option value="">-- Chọn điểm nhận hàng --</option>';
                    if (data.pickup_points.length > 0) {
                        data.pickup_points.forEach(point => {
                            let timeText = point.time_from_departure ? ` (+${point.time_from_departure}p)` : '';
                            pickupSelect.innerHTML += `<option value="${point.id}">${point.name} ${timeText} - ${point.address}</option>`;
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
                            dropoffSelect.innerHTML += `<option value="${point.id}">${point.name} ${timeText} - ${point.address}</option>`;
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
            loadPoints(this.value);
        });

        if (routeSelect.value) {
            loadPoints(routeSelect.value);
        }
    });
</script>
@endpush
