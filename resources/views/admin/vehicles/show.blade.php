@extends('layout.admin.AdminLayout')

@section('content-main')
<h3 class="mb-4">Chi tiết xe</h3>

<div class="card w-50">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $vehicle->id }}</td>
            </tr>
            <tr>
                <th>Biển số</th>
                <td>{{ $vehicle->license_plate }}</td>
            </tr>
            <tr>
                <th>Loại xe</th>
                <td>{{ $vehicle->type ?? '—' }}</td>
            </tr>
            <tr>
                <th>Số ghế</th>
                <td>{{ $vehicle->total_seats }}</td>
            </tr>
            <tr>
                <th>Trạng thái</th>
                <td>
                    <span class="badge bg-{{ $vehicle->status == 'active' ? 'success' : 'warning' }}">
                        {{ $vehicle->status }}
                    </span>
                </td>
            </tr>
            
        </table>

        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
            Quay lại
        </a>

        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning">
            Sửa
        </a>
    </div>
</div>
@endsection
