@extends('admin.dashboard')
@section('title', 'Danh sách địa điểm')
@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách tỉnh / thành</h5>
        <a href="{{ route('locations.create') }}" class="btn btn-success btn-sm">
            + Thêm mới
        </a>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="80">ID</th>
                    <th>Tên tỉnh/thành</th>
                    <th width="160">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($locations as $location)
                    <tr>
                        <td>{{ $location->id }}</td>
                        <td>{{ $location->name }}</td>
                        <td>
                            <a href="{{ route('locations.edit', $location) }}"
                               class="btn btn-warning btn-sm">
                                Sửa
                            </a>

                            <form action="{{ route('locations.destroy', $location) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Bạn chắc chắn muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Chưa có dữ liệu
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection