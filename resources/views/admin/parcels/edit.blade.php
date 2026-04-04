@extends('layout.admin.AdminLayout')
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
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Tên người gửi</label>
                            <input type="text" name="sender_name" value="{{ old('sender_name', $parcel->sender_name) }}" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">SĐT người gửi</label>
                            <input type="text" name="sender_phone" value="{{ old('sender_phone', $parcel->sender_phone) }}" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Tên người nhận</label>
                            <input type="text" name="receiver_name" value="{{ old('receiver_name', $parcel->receiver_name) }}" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">SĐT người nhận</label>
                            <input type="text" name="receiver_phone" value="{{ old('receiver_phone', $parcel->receiver_phone) }}" class="form-control rounded-3">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">Mô tả hàng hoá</label>
                            <textarea name="description" rows="2" class="form-control rounded-3">{{ old('description', $parcel->description) }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Khối lượng (kg)</label>
                            <input type="number" step="0.01" name="weight" value="{{ old('weight', $parcel->weight) }}" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Phí vận chuyển (VNĐ)</label>
                            <input type="number" name="price" value="{{ old('price', $parcel->price) }}" class="form-control rounded-3">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Trạng thái</label>
                            <select name="status" class="form-select rounded-3">
                                @foreach(['pending'=>'Chờ xử lý','shipping'=>'Đang vận chuyển','completed'=>'Hoàn thành','cancelled'=>'Đã huỷ'] as $val => $label)
                                    <option value="{{ $val }}" {{ old('status', $parcel->status)==$val?'selected':'' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">Tuyến đường</label>
                            <select name="route_id" class="form-select rounded-3">
                                <option value="">-- Chọn tuyến đường --</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}" {{ old('route_id', $parcel->route_id)==$route->id?'selected':'' }}>
                                        {{ $route->departureLocation->name ?? '' }} → {{ $route->destinationLocation->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">Cập nhật</button>
                        <a href="{{ route('admin.parcels.index') }}" class="btn btn-light px-4 border">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
