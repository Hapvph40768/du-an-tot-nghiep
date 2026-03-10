

<?php $__env->startSection('content-main'); ?>
<div class="container mt-4">
    <h3 class="mb-3">Quản lý xe</h3>

    
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
    
    <a href="<?php echo e(route('vehicles.create')); ?>" class="btn btn-primary mb-3">
        Thêm xe
    </a>

    
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Biển số</th>
            <th>Loại xe</th>
            <th>Số ghế</th>
            <th>Trạng thái</th>
            <th width="160">Hành động</th>
        </tr>
        </thead>

        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($v->id); ?></td>
                <td><?php echo e($v->license_plate); ?></td>
                <td><?php echo e($v->type); ?></td>
                <td><?php echo e($v->total_seats); ?></td>
                <td>
                    <span class="badge bg-<?php echo e($v->status === 'active' ? 'success' : 'warning'); ?>">
                        <?php echo e($v->status); ?>

                    </span>
                </td>
                
                <td>
                    <a href="<?php echo e(route('vehicles.show', $v)); ?>"
                       class="btn btn-sm btn-info">
                        Xem
                    </a>
                    <a href="<?php echo e(route('vehicles.edit', $v)); ?>"
                       class="btn btn-sm btn-warning">
                        Sửa
                    </a>

                    <form action="<?php echo e(route('vehicles.destroy', $v)); ?>"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Bạn chắc chắn muốn xóa xe này?')">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/vehicles/index.blade.php ENDPATH**/ ?>