@extends('layout.admin.AdminLayout')
@section('content-main')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Quản lý Tuyến đường</h3>
            <a href="{{ route('admin.routes.create') }}" class="btn btn-primary px-4" style="background: #ff6b00; border:none; border-radius: 10px;">
                <i class='bx bx-plus-circle'></i> Thêm Tuyến mới
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle" style="table-layout: fixed;">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th style="width: 10%;">ID</th>
                        <th style="width: 35%;">Điểm đi -> Điểm đến</th>
                        <th style="width: 20%;">Khoảng cách</th>
                        <th style="width: 20%;">Thời gian dự kiến</th>
                        <th style="width: 15%; text-align: right;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($routes as $route)
                    <tr>
                        <td>#{{ $route->id }}</td>
                        <td>
                            <div class="fw-bold text-dark">
                                {{ $route->departureLocation->name }} 
                                <i class='bx bx-right-arrow-alt text-primary'></i> 
                                {{ $route->destinationLocation->name }}
                            </div>
                        </td>
                        <td>{{ $route->distance_km }} km</td>
                        <td>{{ $route->estimated_time }} giờ</td>
                        <td class="text-end">
                            <a href="{{ route('admin.routes.edit', $route->id) }}" class="btn btn-sm btn-light border"><i class='bx bx-edit'></i></a>
                            <form action="{{ route('admin.routes.destroy', $route->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light border text-danger"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="mt-3">{{ $routes->links() }}</div> --}}
    </div>
</div>
@endsection