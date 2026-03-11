<?php $__env->startSection('title', 'Quản lý Đội xe'); ?>

<?php $__env->startSection('content-main'); ?>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h5 class="text-muted mb-1 small text-uppercase fw-bold">Quản trị viên</h5>
            <h2 class="fw-bold text-dark m-0">Danh sách Đội xe</h2>
        </div>

        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-decoration-none text-muted">
                        Trang chủ
                    </a>
                </li>
                <li class="breadcrumb-item active text-primary">
                    Đội xe
                </li>
            </ol>
        </nav>
    </div>

    <div class="card shadow-sm p-4">

        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between mb-3">

            
            <form action="<?php echo e(route('admin.vehicles.index')); ?>" method="GET" class="d-flex gap-2">
                <input type="text"
                       name="keyword"
                       value="<?php echo e(request('keyword')); ?>"
                       class="form-control"
                       placeholder="Tìm biển số, loại xe...">

                <select name="status" class="form-select">
                    <option value="">Tất cả trạng thái</option>
                    <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>
                        Hoạt động
                    </option>
                    <option value="maintenance" <?php echo e(request('status') == 'maintenance' ? 'selected' : ''); ?>>
                        Bảo dưỡng
                    </option>
                </select>

                <button class="btn btn-primary">Lọc</button>
            </form>

            
            <a href="<?php echo e(route('admin.vehicles.create')); ?>" class="btn btn-success">
                + Thêm Xe
            </a>

        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">

                <thead class="table-light">
                    <tr>
                        <th>Biển số</th>
                        <th>Loại xe</th>
                        <th>Số ghế</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th width="120">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>

                            <td><?php echo e($vehicle->license_plate); ?></td>

                            <td><?php echo e($vehicle->type ?? 'Chưa xác định'); ?></td>

                            <td><?php echo e($vehicle->total_seats); ?></td>

                            <td>
                                <?php if($vehicle->status == 'active'): ?>
                                    <span class="badge bg-success">Hoạt động</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Bảo dưỡng</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php echo e($vehicle->created_at ? \Carbon\Carbon::parse($vehicle->created_at)->format('d/m/Y') : 'N/A'); ?>

                            </td>

                            <td>

                                <a href="<?php echo e(route('admin.vehicles.edit', $vehicle->id)); ?>"
                                   class="btn btn-sm btn-warning">
                                    Sửa
                                </a>

                                <form action="<?php echo e(route('admin.vehicles.destroy', $vehicle->id)); ?>"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button class="btn btn-sm btn-danger">
                                        Xóa
                                    </button>

                                </form>

                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                Không có dữ liệu
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

        

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/vehicles/index.blade.php ENDPATH**/ ?>