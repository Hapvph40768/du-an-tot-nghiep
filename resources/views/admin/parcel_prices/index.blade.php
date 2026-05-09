@extends('layout.admin')

@section('header-title', 'QUẢN LÝ GIÁ KÝ GỬI')
@section('header-subtitle', 'Cấu hình giá ký gửi theo tuyến và trọng lượng')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold m-0">Bảng giá ký gửi hàng hóa</h3>
                <a href="{{ route('admin.parcel_prices.create') }}" class="btn btn-primary">
                    <i class='bx bx-plus'></i> Thêm giá mới
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    @if($prices->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-inbox" style="font-size: 3rem; opacity: 0.3;"></i>
                            <p class="mt-3">Chưa có bảng giá nào</p>
                            <a href="{{ route('admin.parcel_prices.create') }}" class="btn btn-sm btn-primary mt-2">
                                Tạo giá đầu tiên
                            </a>
                        </div>
                    @else
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-bold">Tuyến</th>
                                    <th class="fw-bold">Khối lượng từ (kg)</th>
                                    <th class="fw-bold">Khối lượng đến (kg)</th>
                                    <th class="fw-bold">Giá (VNĐ)</th>
                                    <th class="fw-bold">Mô tả</th>
                                    <th class="fw-bold text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prices as $price)
                                    <tr class="align-middle" style="cursor: pointer;">
                                        <td>
                                            <a href="{{ route('admin.parcel_prices.show', $price->id) }}" class="text-decoration-none fw-bold text-dark">
                                                {{ $price->route->departureLocation->name ?? '...' }}
                                                <i class="fas fa-arrow-right text-muted mx-1"></i>
                                                {{ $price->route->destinationLocation->name ?? '...' }}
                                            </a>
                                        </td>
                                        <td class="align-middle">{{ number_format($price->weight_from, 2) }}</td>
                                        <td class="align-middle">{{ number_format($price->weight_to, 2) }}</td>
                                        <td class="align-middle text-danger fw-bold">
                                            {{ number_format($price->price, 0, ',', '.') }}đ
                                        </td>
                                        <td class="align-middle text-muted text-truncate" style="max-width: 200px; cursor: default;">
                                            {{ $price->description ?? 'N/A' }}
                                        </td>
                                        <td class="align-middle text-center" style="cursor: default;">
                                            <a href="{{ route('admin.parcel_prices.show', $price->id) }}" class="badge bg-info text-white" title="Xem chi tiết">
                                                <i class='bx bx-show'></i>
                                            </a>
                                            <a href="{{ route('admin.parcel_prices.edit', $price->id) }}" class="badge bg-warning text-dark" title="Chỉnh sửa">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <form action="{{ route('admin.parcel_prices.destroy', $price->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Xác nhận xóa?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge bg-danger" style="border:none; cursor:pointer;" title="Xóa">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="d-flex justify-content-center mt-4 pb-3">
                            {{ $prices->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
