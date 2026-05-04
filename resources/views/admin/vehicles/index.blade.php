@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Xe')

@section('content-main')
    <style>
        :root {
            --primary-color: #ff6b00;
            --primary-hover: #e65100;
        }} .card-box {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0f0f0;
        }} .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
        }} .custom-table thead th {
            background-color: #f9fafb;
            color: #6b7280;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            padding: 16px;
            border-bottom: 2px solid #edf2f7;
            text-align: left;
        }} .custom-table td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
            text-align: left;
            font-size: 14px;
        }} .btn-primary-custom {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 8px 18px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: 0.3s;
        }} .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            color: white;
            transform: translateY(-2px);
        }} .status-active {
            color: #059669;
            background: #ecfdf5;
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
        }} .status-maintenance {
            color: #dc2626;
            background: #fef2f2;
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
        }}</style>

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark m-0">Danh sách Xe</h2>
                <p class="text-muted small mb-0">Quản lý đội xe và sơ đồ ghế</p>
            </div>
            <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary-custom">
                <i class='bx bx-plus-circle fs-5'></i> Thêm Xe mới
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
                <i class='bx bx-check-circle'></i> {{ session('success') }}}</div>
        @endif

        <div class="card-box">
            <div class="table-responsive">
                <table class="custom-table w-100">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width: 20%;">Biển số</th>
                            <th style="width: 25%;">Loại xe</th>
                            <th style="width: 15%;">Số ghế</th>
                            <th style="width: 20%;">Số điện thoại</th>
                            <th style="width: 20%;">{{{ __('status') }}</th>
                            <th class="text-end pe-4" style="width: 20%;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehicles as $vehicle)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $vehicle->license_plate }}}</div>
                                </td>

                                <td>
                                    <span class="text-muted small fw-bold">{{ $vehicle->type }}}</span>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $vehicle->total_seats }}} ghế
                                    </span>
                                </td>


                                <td>
                                    @if ($vehicle->phone_vehicles)
                                        <i class='bx bxs-phone-call text-success me-1'></i>
                                        {{ $vehicle->phone_vehicles }}} @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($vehicle->status == 'active')
                                        <span class="status-active">
                                            <i class='bx bxs-circle fs-6 me-1'></i>Sẵn sàng
                                        </span>
                                    @else
                                        <span class="status-maintenance">
                                            <i class='bx bxs-wrench fs-6 me-1'></i>Bảo trì
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.vehicles.show', $vehicle->id) }}"
                                            class="btn btn-sm btn-light border" title="Xem sơ đồ ghế">
                                            <i class='bx bx-show text-info'></i>
                                        </a>

                                        <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}"
                                            class="btn btn-sm btn-light border" title="="{{{ __('edit') }">
                                            <i class='bx bx-edit text-primary'></i>
                                        </a>

                                        <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST"
                                            onsubmit="return confirm('Xóa xe này sẽ xóa toàn bộ sơ đồ ghế liên quan. Tiếp tục?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-light border text-danger" title="="{{{ __('delete') }">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    Chưa có xe nào trong danh sách.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $vehicles->links('pagination::bootstrap-5') }}}</div>
        </div>
    </div>
@endsection
