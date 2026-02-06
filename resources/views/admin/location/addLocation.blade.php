@extends('admin.dashboard')
@section('title', 'Thêm địa điểm')
@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Thêm tỉnh / thành</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('locations.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên tỉnh/thành</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}">

                @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary">Lưu</button>
            <a href="{{ route('locations.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection