

<?php $__env->startSection('title', 'Quản lý Đội xe'); ?>

<?php $__env->startSection('content-main'); ?>

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

        .action-btn.delete-btn:hover {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 6px;
        }

        .bg-soft-success {
            background: #d1fae5;
            color: #065f46;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .bg-soft-warning {
            background: #fef3c7;
            color: #92400e;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .bg-soft-secondary {
            background: #f3f4f6;
            color: #374151;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }

        .vehicle-plate {
            font-family: monospace;
            font-weight: 700;
            letter-spacing: 1px;
        }
    </style>

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h5 class="text-muted mb-1 small text-uppercase fw-bold ls-1">Quản trị viên</h5>
                <h2 class="fw-bold text-dark m-0">Danh sách Đội xe</h2>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"
                            class="text-decoration-none text-muted">Trang chủ</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Đội xe</li>
                </ol>
            </nav>
        </div>

        <div class="card-box">

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class='bx bx-check-circle me-1'></i> <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class='bx bx-error-circle me-1'></i> <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="toolbar-area">

                <form action="<?php echo e(route('admin.vehicles.index')); ?>" method="GET" class="d-flex gap-3 flex-grow-1">

                    <div class="search-box">
                        <i class='bx bx-search'></i>
                        <input type="text" name="keyword" value="<?php echo e(request('keyword')); ?>" class="form-control"
                            placeholder="Tìm biển số, loại xe...">
                    </div>

                    <select name="status" class="form-select form-select-custom" style="width: 180px;"
                        onchange="this.form.submit()">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Hoạt động</option>
                        <option value="maintenance" <?php echo e(request('status') == 'maintenance' ? 'selected' : ''); ?>>Bảo dưỡng
                        </option>
                    </select>
                </form>

                <a href="<?php echo e(route('admin.vehicles.create')); ?>" class="btn btn-primary-custom">
                    <i class='bx bx-plus-circle'></i> Thêm Xe Mới
                </a>
            </div>

            <div class="table-responsive">
                <table class="custom-table align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Biển số</th>
                            <th>Loại xe / Số ghế</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th class="text-end pe-4">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($vehicles->count() > 0): ?>
                            <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div
                                                class="avatar-box bg-light d-flex align-items-center justify-content-center">
                                                <i class='bx bx-car fs-4 text-primary'></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold vehicle-plate"><?php echo e($vehicle->license_plate); ?></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-medium text-dark">
                                                <?php echo e($vehicle->type ?? 'Chưa xác định'); ?>

                                            </span>
                                            <small class="text-muted mt-1">
                                                <?php echo e($vehicle->total_seats); ?> chỗ
                                            </small>
                                        </div>
                                    </td>

                                    <td>
                                        <?php if($vehicle->status == 'active'): ?>
                                            <span class="bg-soft-success">
                                                <span class="status-dot bg-success"></span>Hoạt động
                                            </span>
                                        <?php else: ?>
                                            <span class="bg-soft-warning">
                                                <span class="status-dot bg-warning"></span>Bảo dưỡng
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <span class="text-muted small">
                                            <?php echo e($vehicle->created_at ? $vehicle->created_at->format('d/m/Y') : 'N/A'); ?>

                                        </span>
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="action-group">
                                            <a href="<?php echo e(route('admin.vehicles.edit', $vehicle->id)); ?>" class="action-btn"
                                                title="Chỉnh sửa">
                                                <i class='bx bx-edit fs-5'></i>
                                            </a>

                                            <form action="<?php echo e(route('admin.vehicles.destroy', $vehicle->id)); ?>"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa xe biển <?php echo e($vehicle->license_plate); ?>?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button type="submit" class="action-btn delete-btn" title="Xóa"
                                                    style="border: none;">
                                                    <i class='bx bx-trash fs-5'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class='bx bx-car fs-1 mb-3 d-block'></i>
                                        Chưa có xe nào trong hệ thống hoặc không tìm thấy kết quả phù hợp.
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
                <small class="text-muted">
                    Đang hiển thị <strong><?php echo e($vehicles->count()); ?></strong> trên tổng số
                    <strong><?php echo e($vehicles->total()); ?></strong> xe
                </small>

                <div>
                    <?php echo e($vehicles->appends(request()->query())->links('pagination::bootstrap-4')); ?>

                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/vehicles/index.blade.php ENDPATH**/ ?>