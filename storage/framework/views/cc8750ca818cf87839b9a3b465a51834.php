<?php $__env->startSection('title', 'Danh sách địa điểm'); ?>
<?php $__env->startSection('content'); ?>
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh sách tỉnh / thành</h5>
        <a href="<?php echo e(route('admin.locations.create')); ?>" class="btn btn-success btn-sm">
            + Thêm mới
        </a>
    </div>

    <div class="card-body">

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="80">ID</th>
                    <th>Tên tỉnh/thành</th>
                    <th width="160">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($location->id); ?></td>
                        <td><?php echo e($location->name); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.locations.edit', $location)); ?>"
                               class="btn btn-warning btn-sm">
                                Sửa
                            </a>

                            <form action="<?php echo e(route('admin.locations.destroy', $location)); ?>"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Bạn chắc chắn muốn xóa?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Chưa có dữ liệu
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/location/listLocation.blade.php ENDPATH**/ ?>