

<?php $__env->startSection('content-main'); ?>
<h3 class="mb-4">Chi tiết xe</h3>

<div class="card w-50">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td><?php echo e($vehicle->id); ?></td>
            </tr>
            <tr>
                <th>Biển số</th>
                <td><?php echo e($vehicle->license_plate); ?></td>
            </tr>
            <tr>
                <th>Loại xe</th>
                <td><?php echo e($vehicle->type ?? '—'); ?></td>
            </tr>
            <tr>
                <th>Số ghế</th>
                <td><?php echo e($vehicle->total_seats); ?></td>
            </tr>
            <tr>
                <th>Trạng thái</th>
                <td>
                    <span class="badge bg-<?php echo e($vehicle->status == 'active' ? 'success' : 'warning'); ?>">
                        <?php echo e($vehicle->status); ?>

                    </span>
                </td>
            </tr>
            
        </table>

        <a href="<?php echo e(route('vehicles.index')); ?>" class="btn btn-secondary">
            Quay lại
        </a>

        <a href="<?php echo e(route('vehicles.edit', $vehicle->id)); ?>" class="btn btn-warning">
            Sửa
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/vehicles/show.blade.php ENDPATH**/ ?>