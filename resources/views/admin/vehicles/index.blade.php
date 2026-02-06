@extends('layout.admin.AdminLayout')

@section('content-main')
<div class="container mt-4">
    <h3 class="mb-3">Quản lý xe</h3>

    {{-- thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- nút thêm --}}
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary mb-3">
        Thêm xe
    </a>

    {{-- bảng --}}
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Biển số</th>
            <th>Loại xe</th>
            <th>Số ghế</th>
            <th>Trạng thái</th>
            <th width="160">Hành động</th>
        </tr>
        </thead>

        <tbody>
        @forelse($vehicles as $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ $v->license_plate }}</td>
                <td>{{ $v->type }}</td>
                <td>{{ $v->total_seats }}</td>
                <td>
                    <span class="badge bg-{{ $v->status === 'active' ? 'success' : 'warning' }}">
                        {{ $v->status }}
                    </span>
                </td>
                
                <td>
                    <a href="{{ route('vehicles.show', $v) }}"
                       class="btn btn-sm btn-info">
                        Xem
                    </a>
                    <a href="{{ route('vehicles.edit', $v) }}"
                       class="btn btn-sm btn-warning">
                        Sửa
                    </a>

                    <form action="{{ route('vehicles.destroy', $v) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Bạn chắc chắn muốn xóa xe này?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">
                    Không có dữ liệu
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
