@extends('layout.admin.AdminLayout')
@section('content-main')
<div class="container-fluid py-4">
    @if($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm"><ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Thêm Khuyến mãi mới</h4>
                <form action="{{ route('admin.promotions.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Mã khuyến mãi</label>
                            <input type="text" name="code" value="{{ old('code') }}" class="form-control rounded-3 @error('code') is-invalid @enderror" placeholder="VD: SALE20">
                            @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Loại giảm giá</label>
                            <select name="type" class="form-select rounded-3 @error('type') is-invalid @enderror">
                                <option value="percent" {{ old('type')=='percent'?'selected':'' }}>Phần trăm (%)</option>
                                <option value="fixed" {{ old('type')=='fixed'?'selected':'' }}>Cố định (VNĐ)</option>
                            </select>
                            @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Giá trị giảm</label>
                            <input type="number" name="value" value="{{ old('value') }}" class="form-control rounded-3 @error('value') is-invalid @enderror" placeholder="VD: 20 hoặc 50000">
                            @error('value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Số lần dùng tối đa</label>
                            <input type="number" name="max_uses" value="{{ old('max_uses') }}" class="form-control rounded-3" placeholder="Để trống = không giới hạn">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">{{ __('date') }} bắt đầu</label>
                            <input type="datetime-local" name="start_date" value="{{ old('start_date') }}" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">{{ __('date') }} kết thúc</label>
                            <input type="datetime-local" name="end_date" value="{{ old('end_date') }}" class="form-control rounded-3">
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">{{ __('save') }} khuyến mãi</button>
                        <a href="{{ route('admin.promotions.index') }}" class="btn btn-light px-4 border">{{ __('cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
