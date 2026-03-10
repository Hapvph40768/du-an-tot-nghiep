@extends('layout.admin.AdminLayout')

@section('content-main')

<div class="container">
    <h2>Thêm điểm đón</h2>

    <form action="{{ route('admin.pickup-points.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Tên điểm đón</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Khu vực</label>
            <select name="location_id" class="form-control" required>
                <option value="">-- Chọn khu vực --</option>

                @foreach($locations as $location)
                <option value="{{ $location->id }}">
                    {{ $location->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Thêm</button>

    </form>
</div>

@endsection