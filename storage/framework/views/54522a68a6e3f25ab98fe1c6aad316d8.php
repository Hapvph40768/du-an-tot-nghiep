

<?php $__env->startSection('content-main'); ?>
<h3>Cập nhật xe</h3>

<form action="<?php echo e(route('vehicles.update', $vehicle->id)); ?>" method="POST" class="w-50">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="mb-3">
        <label>Biển số</label>
        <input type="text" name="license_plate" value="<?php echo e($vehicle->license_plate); ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Loại xe</label>
        <input type="text" name="type" value="<?php echo e($vehicle->type); ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>Số ghế</label>
        <input type="number" name="total_seats" value="<?php echo e($vehicle->total_seats); ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-select">
            <option value="active" <?php echo e($vehicle->status == 'active' ? 'selected' : ''); ?>>Hoạt động</option>
            <option value="maintenance" <?php echo e($vehicle->status == 'maintenance' ? 'selected' : ''); ?>>Bảo trì</option>
        </select>
    </div>

    <button class="btn btn-primary">Cập nhật</button>
    <a href="<?php echo e(route('vehicles.index')); ?>" class="btn btn-secondary">Quay lại</a>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/vehicles/edit.blade.php ENDPATH**/ ?>