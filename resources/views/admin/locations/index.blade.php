@extends('layout.admin')

@section('title', 'Quản lý Địa điểm')

@section('content-main')

    <style>
        :root {
            --primary-color: #ff6b00;
            --primary-hover: #e65100;
            --bg-light: #f9fafb;
        }} .card-box {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0f0f0;
            padding: 24px;
        }} .toolbar-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            gap: 15px;
        }} .btn-primary-custom {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }} .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 0, 0.3);
            color: white;
        }} .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
            text-align: left;
        }} .custom-table thead th {
            background-color: #f9fafb;
            color: #6b7280;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            padding: 16px;
            border-bottom: 2px solid #edf2f7;
        }} .custom-table td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
            font-size: 14px;
        }} .action-group {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }} .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            transition: all 0.2s;
            background: transparent;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }} .action-btn:hover {
            background-color: #edf2f7;
            color: var(--primary-color);
        }} .action-btn.delete-btn:hover {
            background-color: #fee2e2;
            color: #dc2626;
        }} .custom-table td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
            text-align: left;
            /* Đảm bảo nội dung căn trái */
        }} /* Căn phải riêng cho cột hành động */
        .text-end {
            text-align: right !important;
        }}</style>

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h5 class="text-muted mb-1 small text-uppercase fw-bold">Hệ thống bến xe</h5>
                <h2 class="fw-bold text-dark m-0">Danh sách Địa điểm</h2>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">{{ __('home') }}</a></li>
                    <li class="breadcrumb-item active text-primary">{{ __('locations') }}</li>
                </ol>
            </nav>
        </div>

        <div class="card-box">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class='bx bx-check-circle me-1'></i> {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="toolbar-area">
                <div class="text-muted small">
                    Tổng cộng: <strong>{{ $locations->total() }}</strong> địa điểm
                </div>
                <a href="{{ route('admin.locations.create') }}" class="btn btn-primary-custom">
                    <i class='bx bx-plus-circle'></i> Thêm mới
                </a>
            </div>

            <div class="table-responsive">
                <table class="custom-table w-100">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width: 10%;">ID</th>
                            <th style="width: 45%;">{{ __('name') }} địa điểm / Bến xe</th>
                            <th style="width: 25%;">{{ __('created_at') }}</th>
                            <th class="text-end pe-4" style="width: 20%;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($locations as $location)
                            <tr>
                                <td class="ps-4 text-muted">#{{ $location->id }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $location->name }}</div>
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        {{ $location->created_at->format('d/m/Y H:i') }}</span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="action-group">
                                        <a href="{{ route('admin.locations.edit', $location->id) }}" class="action-btn"
                                            title="Chỉnh sửa">
                                            <i class='bx bx-edit fs-5'></i>
                                        </a>

                                        <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Xóa địa điểm này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="="{{ __('delete') }}">
                                                <i class='bx bx-trash fs-5'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    Chưa có dữ liệu địa điểm.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $locations->links('pagination::bootstrap-5') }}</div>

        </div>
    </div>

@endsection
