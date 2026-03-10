@extends('layout.admin.AdminLayout')

{{-- Đặt tiêu đề cho tab trình duyệt --}}
@section('title', 'Quản lý Đội xe')

@section('content-main')

    <style>
        /* --- CSS TÙY CHỈNH CHO TRANG NÀY (SaaS Style) --- */
        :root {
            --primary-color: #ff6b00; /* Màu cam thương hiệu */
            --primary-hover: #e65100;
            --bg-light: #f9fafb;
        }

        /* 1. Card Container: Khung trắng nổi bật */
        .card-box {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid #f0f0f0;
            padding: 24px;
        }

        /* 2. Toolbar: Thanh công cụ */
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
            width: 300px;
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

        /* 3. Button & Filter */
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

        /* 4. Table Design */
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

        .custom-table tbody tr {
            transition: all 0.2s;
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

        /* 5. Avatar & Info */
        .driver-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #e2e8f0;
            flex-shrink: 0;
        }

        .avatar-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Action Buttons */
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
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .action-btn:hover {
            background-color: #edf2f7;
            color: var(--primary-color);
        }

        /* Style riêng cho nút xóa khi hover */
        .action-btn.delete-btn:hover {
            background-color: #fee2e2;
            color: #dc2626;
        }

        /* Status Badge */
        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 6px;
        }

        .bg-soft-success { background: #d1fae5; color: #065f46; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 12px; }
        .bg-soft-warning { background: #fef3c7; color: #92400e; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 12px; }
        .bg-soft-secondary { background: #f3f4f6; color: #374151; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 12px; }
    </style>

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h5 class="text-muted mb-1 small text-uppercase fw-bold ls-1">Quản trị viên</h5>
                <h2 class="fw-bold text-dark m-0">Danh sách Tài xế</h2>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Trang chủ</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Tài xế</li>
                </ol>
            </nav>
        </div>

        <div class="card-box">

            {{-- Thông báo thành công --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class='bx bx-check-circle me-1'></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="toolbar-area">
                {{-- 
                    ĐÃ SỬA: Thay thẻ <div> bằng <form> để gửi dữ liệu tìm kiếm
                    - Action: Gửi về route index
                    - Method: GET
                --}}
                <form action="{{ route('drivers.index') }}" method="GET" class="d-flex gap-3 flex-grow-1">
                    
                    <div class="search-box">
                        <i class='bx bx-search'></i>
                        {{-- Thêm name="keyword" và value="{{ request('keyword') }}" để giữ lại chữ đã nhập --}}
                        <input type="text" 
                               name="keyword" 
                               value="{{ request('keyword') }}"
                               class="form-control" 
                               placeholder="Tìm tên, SĐT, bằng lái...">
                    </div>

                    {{-- Thêm name="status" và logic selected --}}
                    <select name="status" class="form-select form-select-custom" style="width: 180px;" onchange="this.form.submit()">
                        <option value="">Tất cả trạng thái</option>
                        
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                            Đang hoạt động
                        </option>
                        
                        <option value="busy" {{ request('status') == 'busy' ? 'selected' : '' }}>
                            Đang chạy
                        </option>
                        
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                            Đã nghỉ
                        </option>
                    </select>
                </form>

                {{-- NÚT THÊM MỚI (Giữ nguyên) --}}
                <a href="{{ route('drivers.create') }}" class="btn btn-primary-custom">
                    <i class='bx bx-plus-circle'></i> Thêm Tài xế
                </a>
            </div>

            <div class="table-responsive">
                <table class="custom-table align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Tài xế</th>
                            <th>Thông tin liên hệ</th>
                            <th>Bằng lái / Hạng</th>
                            <th>Trạng thái</th>
                            <th>Ngày tham gia</th>
                            <th class="text-end pe-4">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($drivers->count() > 0)
                            @foreach($drivers as $driver)
                                <tr>
                                    <td class="ps-4">
                                        <div class="driver-info">
                                            <div class="avatar-box">
                                                @if($driver->image && file_exists(public_path($driver->image)))
                                                    <img src="{{ asset($driver->image) }}" alt="{{ $driver->name }}">
                                                @else
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($driver->name) }}&background=random&color=fff&size=128&bold=true"
                                                        alt="Avatar">
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark">{{ $driver->name }}</h6>
                                                <small class="text-muted">ID: #{{ $driver->id }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium text-dark">
                                                <i class='bx bx-phone text-muted me-1'></i> {{ $driver->phone }}
                                            </span>
                                            <span class="text-muted small mt-1">user{{$driver->id}}@example.com</span>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark border px-3 py-2">
                                            <i class='bx bx-id-card me-1'></i> {{ $driver->license_number }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($driver->status == 'active')
                                            <span class="bg-soft-success"><span class="status-dot bg-success"></span>Hoạt động</span>
                                        @elseif($driver->status == 'busy')
                                            <span class="bg-soft-warning"><span class="status-dot bg-warning"></span>Đang chạy</span>
                                        @else
                                            <span class="bg-soft-secondary"><span class="status-dot bg-secondary"></span>Đã nghỉ</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="text-muted small">
                                            {{ $driver->created_at ? $driver->created_at->format('d/m/Y') : 'N/A' }}
                                        </span>
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="action-group">
                                            <a href="{{ route('drivers.edit', $driver->id) }}" class="action-btn" title="Chỉnh sửa">
                                                <i class='bx bx-edit fs-5'></i>
                                            </a>

                                            <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài xế {{ $driver->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                
                                                <button type="submit" class="action-btn delete-btn" title="Xóa" style="border: none;">
                                                    <i class='bx bx-trash fs-5'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            {{-- Hiển thị khi không tìm thấy kết quả nào --}}
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class='bx bx-search-alt fs-1 mb-3 d-block'></i>
                                        Không tìm thấy tài xế nào phù hợp.
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
                <small class="text-muted">Đang hiển thị <strong>{{ $drivers->count() }}</strong> trên tổng số <strong>{{ $drivers->total() }}</strong> tài xế</small>

                <div>
                    {{-- Thêm withQueryString() để giữ bộ lọc khi qua trang 2 --}}
                    {{ $drivers->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>
    </div>
@endsection