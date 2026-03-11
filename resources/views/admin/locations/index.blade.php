@extends('layout.admin.AdminLayout')

@section('title', 'Quản lý Địa điểm')

@section('content-main')

    <style>
        :root {
            --primary-color: #ff6b00;
            --primary-hover: #e65100;
            --bg-light: #f9fafb;
        }

        .card-box {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0f0f0;
            padding: 24px;
        }

        .toolbar-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-box {
            position: relative;
            width: 320px;
        }

        .search-box input {
            padding-left: 40px;
            border-radius: 10px;
            background-color: var(--bg-light);
            border: 1px solid #e9ecef;
            height: 45px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .search-box input:focus {
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.1);
            border-color: var(--primary-color);
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
        }

        .btn-primary-custom {
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
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 0, 0.3);
            color: white;
        }

        .form-select-custom {
            border-radius: 10px;
            background-color: var(--bg-light);
            border: 1px solid #e9ecef;
            height: 45px;
            cursor: pointer;
        }

        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .custom-table thead th {
            background-color: #f9fafb;
            color: #6b7280;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px;
            border-bottom: 2px solid #edf2f7;
        }

        .custom-table tbody tr:hover {
            background-color: #fff8f3;
        }

        .custom-table td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
            font-size: 14px;
        }

        .action-group {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            transition: all 0.2s;
            background: transparent;
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
        }

        .action-btn:hover {
            background-color: #edf2f7;
            color: var(--primary-color);
        }

        .action-btn.delete-btn:hover {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }
    </style>

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h5 class="text-muted mb-1 small text-uppercase fw-bold ls-1">Quản trị viên</h5>
                <h2 class="fw-bold text-dark m-0">Quản lý Địa điểm / Bến xe</h2>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Trang chủ</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Địa điểm</li>
                </ol>
            </nav>
        </div>

        <div class="card-box">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class='bx bx-check-circle me-1'></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="toolbar-area">
                <form action="{{ route('admin.locations.index') }}" method="GET" class="d-flex gap-3 flex-grow-1">
                    <div class="search-box">
                        <i class='bx bx-search'></i>
                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control"
                            placeholder="Tìm tên địa điểm, địa chỉ, thành phố...">
                    </div>

                    <select name="status" class="form-select form-select-custom" style="width: 180px;"
                        onchange="this.form.submit()">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang hoạt động
                        </option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tạm ngưng</option>
                    </select>
                </form>

                <a href="{{ route('admin.locations.create') }}" class="btn btn-primary-custom">
                    <i class='bx bx-plus-circle'></i> Thêm Địa điểm mới
                </a>
            </div>

            <div class="table-responsive">
                <table class="custom-table align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Tên địa điểm</th>
                            <th>Địa chỉ</th>
                            <th>Thành phố</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th class="text-end pe-4">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($locations->count() > 0)
                            @foreach ($locations as $location)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $location->name }}</div>
                                    </td>
                                    <td>
                                        {{ $location->address ?? '<span class="text-muted">Chưa cập nhật</span>' }}
                                    </td>
                                    <td>
                                        {{ $location->city ?? '<span class="text-muted">—</span>' }}
                                    </td>
                                    <td>
                                        @if ($location->is_active)
                                            <span class="status-active"><span class="status-dot bg-success"></span>Hoạt
                                                động</span>
                                        @else
                                            <span class="status-inactive"><span class="status-dot bg-danger"></span>Tạm
                                                ngưng</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted small">
                                            {{ \Carbon\Carbon::parse($location->created_at)->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="action-group">
                                            <a href="{{ route('admin.locations.edit', $location->id) }}" class="action-btn"
                                                title="Chỉnh sửa">
                                                <i class='bx bx-edit fs-5'></i>
                                            </a>

                                            <form action="{{ route('admin.locations.destroy', $location->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa địa điểm {{ $location->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn delete-btn" title="Xóa"
                                                    style="border: none;">
                                                    <i class='bx bx-trash fs-5'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class='bx bx-map-pin fs-1 mb-3 d-block'></i>
                                        Chưa có địa điểm nào. Hãy thêm mới!
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
                <small class="text-muted">
                    Đang hiển thị <strong>{{ $locations->count() }}</strong> trên tổng số
                    <strong>{{ $locations->total() }}</strong> địa điểm
                </small>
                <div>
                    {{ $locations->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>
    </div>

@endsection
