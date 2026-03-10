@extends('layout.admin.AdminLayout')

@section('content-main')

<div class="container">
    <h2>Sửa điểm đón</h2>

    <form action="{{ route('admin.pickup-points.update', $point->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tên điểm đón</label>
            <input type="text" name="name" class="form-control"
                value="{{ $point->name }}">
        </div>

        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control"
                value="{{ $point->address }}">
        </div>

        <div class="mb-3">
            <label>Khu vực</label>
            <select name="location_id" class="form-control">

                @foreach($locations as $location)
                <option value="{{ $location->id }}"
                    {{ $point->location_id == $location->id ? 'selected' : '' }}>
                    {{ $location->name }}
                </option>
                @endforeach

            </select>
        </div>

        <button class="btn btn-primary">Cập nhật</button>

    </form>
</div>

@endsection