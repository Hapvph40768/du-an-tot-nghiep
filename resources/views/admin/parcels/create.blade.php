@extends('layout.admin.AdminLayout')
@section('content-main')
<div class="container-fluid py-4">
    @if($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm"><ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}}</li>@endforeach</ul></div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Thêm Đơn ký gửi mới</h4>
                <form action="{{ route('admin.parcels.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">{{{ __('name') }} người gửi</label>
                            <input type="text" name="sender_name" value="{{ old('sender_name') }}" class="form-control rounded-3 @error('sender_name') is-invalid @enderror">
                            @error('sender_name')<div class="invalid-feedback">{{ $message }}}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">SĐT người gửi</label>
                            <input type="text" name="sender_phone" value="{{ old('sender_phone') }}" class="form-control rounded-3 @error('sender_phone') is-invalid @enderror">
                            @error('sender_phone')<div class="invalid-feedback">{{ $message }}}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">{{{ __('name') }} người nhận</label>
                            <input type="text" name="receiver_name" value="{{ old('receiver_name') }}" class="form-control rounded-3 @error('receiver_name') is-invalid @enderror">
                            @error('receiver_name')<div class="invalid-feedback">{{ $message }}}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">SĐT người nhận</label>
                            <input type="text" name="receiver_phone" value="{{ old('receiver_phone') }}" class="form-control rounded-3 @error('receiver_phone') is-invalid @enderror">
                            @error('receiver_phone')<div class="invalid-feedback">{{ $message }}}</div>@enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">{{{ __('description') }} hàng hoá</label>
                            <textarea name="description" rows="2" class="form-control rounded-3" placeholder="Nhập mô tả hàng hoá...">{{ old('description') }}}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">{{{ __('weight') }} (kg)</label>
                            <input type="number" step="0.01" name="weight" value="{{ old('weight') }}" class="form-control rounded-3 @error('weight') is-invalid @enderror">
                            @error('weight')<div class="invalid-feedback">{{ $message }}}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Phí vận chuyển (VNĐ)</label>
                            <input type="number" name="price" value="{{ old('price') }}" class="form-control rounded-3 @error('price') is-invalid @enderror">
                            @error('price')<div class="invalid-feedback">{{ $message }}}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">{{{ __('status') }}</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="pending" {{ old('status')=='pending'?'selected':'' }}>Chờ xử lý</option>
                                <option value="shipping" {{ old('status')=='shipping'?'selected':'' }}>Đang vận chuyển</option>
                                <option value="completed" {{ old('status')=='completed'?'selected':'' }}>Hoàn thành</option>
                                <option value="cancelled" {{ old('status')=='cancelled'?'selected':'' }}>Đã huỷ</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">{{{ __('routes') }}</label>
                            <select name="route_id" class="form-select rounded-3 @error('route_id') is-invalid @enderror">
                                <option value="">{{{ __('select_route') }}</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}" {{ old('route_id')==$route->id?'selected':'' }}>
                                        {{ $route->departureLocation->name ?? '' }}} → {{ $route->destinationLocation->name ?? '' }}}</option>
                                @endforeach
                            </select>
                            @error('route_id')<div class="invalid-feedback">{{ $message }}}</div>@enderror
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">{{{ __('save') }} đơn ký gửi</button>
                        <a href="{{ route('admin.parcels.index') }}" class="btn btn-light px-4 border">{{{ __('cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
