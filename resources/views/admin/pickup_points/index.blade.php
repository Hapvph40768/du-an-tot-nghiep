@extends('layout.admin.AdminLayout')
@section('title', 'Danh mục Điểm đón')
@section('content-main')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark m-0">Danh mục Điểm đón gốc</h2>
            <p class="text-muted small mb-0">Quản lý bến xe, văn phòng dùng chung cho toàn hệ thống</p>
        </div>
        <a href="{{ route('admin.pickup-points.create') }}" class="btn btn-primary px-4 py-2" style="background: #ff6b00; border:none; border-radius: 10px;">
            <i class='bx bx-plus-circle'></i> Thêm điểm đón vào kho
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tỉnh/Thành phố</th>
                        <th>{{{ __('name') }} điểm đón</th>
                        <th>{{{ __('address') }}</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pickupPoints as $point)
                    <tr>
                        <td><span class="badge bg-light text-primary border">{{ $point->location->name }}}</span></td>
                        <td class="fw-bold">{{ $point->name }}}</td>
                        <td class="text-muted small">{{ $point->address }}}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.pickup-points.edit', $point->id) }}" class="btn btn-sm btn-light border text-primary"><i class='bx bx-edit'></i></a>
                            <form action="{{ route('admin.pickup-points.destroy', $point->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xóa điểm này khỏi hệ thống?')"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $pickupPoints->links() }}}</div>
</div>
@endsection