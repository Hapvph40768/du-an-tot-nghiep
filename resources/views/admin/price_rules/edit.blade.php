@extends('layout.admin')
@section('content-main')
<div class="container-fluid py-4">
    @if($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm"><ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-4">Chỉnh sửa Quy tắc Giá vé #{{ $priceRule->id }}</h4>
                <form action="{{ route('admin.price_rules.update', $priceRule->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold small">{{ __('name') }} quy tắc</label>
                            <input type="text" name="name" value="{{ old('name', $priceRule->name) }}" class="form-control rounded-3 @error('name') is-invalid @enderror">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Loại điều chỉnh</label>
                            <select name="type" class="form-select rounded-3">
                                <option value="percentage" {{ old('type', $priceRule->type)=='percentage'?'selected':'' }}>Phần trăm (%)</option>
                                <option value="fixed" {{ old('type', $priceRule->type)=='fixed'?'selected':'' }}>Cố định (VNĐ)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Giá trị điều chỉnh</label>
                            <input type="number" name="value" value="{{ old('value', $priceRule->value) }}" step="0.01" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">{{ __('date') }} bắt đầu</label>
                            <input type="date" name="start_date" value="{{ old('start_date', $priceRule->start_date) }}" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">{{ __('date') }} kết thúc</label>
                            <input type="date" name="end_date" value="{{ old('end_date', $priceRule->end_date) }}" class="form-control rounded-3">
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">{{ __('update') }}</button>
                        <a href="{{ route('admin.price_rules.index') }}" class="btn btn-light px-4 border">{{ __('cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
