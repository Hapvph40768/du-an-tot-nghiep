@extends('layout.admin.AdminLayout')

@section('content-main')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2>Danh sách điểm đón</h2>

        <a href="{{ route('admin.pickup-points.create') }}" class="btn btn-primary">
            + Thêm điểm đón
        </a>
    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên điểm đón</th>
                <th>Địa chỉ</th>
                <th>Khu vực</th>
                <th width="150">Hành động</th>
            </tr>
        </thead>

        <tbody>

            @foreach($points as $point)
            <tr>

                <td>{{ $point->id }}</td>

                <td>{{ $point->name }}</td>

                <td>{{ $point->address }}</td>

                <td>
                    {{ $point->location->name ?? 'N/A' }}
                </td>

                <td>

                    <a href="{{ route('admin.pickup-points.edit', $point->id) }}"
                        class="btn btn-warning btn-sm">
                        Sửa
                    </a>

                    <form action="{{ route('admin.pickup-points.destroy', $point->id) }}"
                        method="POST"
                        style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc muốn xóa?')">
                            Xóa
                        </button>

                    </form>

                </td>

            </tr>
            @endforeach

        </tbody>

    </table>

    <div class="mt-3">
        {{ $points->links() }}
    </div>

</div>

@endsection