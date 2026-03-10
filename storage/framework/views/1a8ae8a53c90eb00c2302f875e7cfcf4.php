

<?php $__env->startSection('content-main'); ?>
<h3>Quản lý đặt vé</h3>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<a href="<?php echo e(route('bookings.create')); ?>" class="btn btn-success mb-3">
    Thêm booking
</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Chuyến</th>
            <th>Điểm đón</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th width="180">Hành động</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($b->id); ?></td>
            <td><?php echo e($b->user->name); ?></td>
            <td><?php echo e($b->trip->id); ?></td>
            <td><?php echo e($b->pickupPoint->name ?? ''); ?></td>
            <td><?php echo e($b->total_amount); ?></td>
            <td>
                <span class="badge bg-<?php echo e($b->status == 'paid' ? 'success' : ($b->status == 'pending' ? 'warning' : 'danger')); ?>">
                    <?php echo e($b->status); ?>

                </span>
            </td>
            <td>
                <a href="<?php echo e(route('bookings.show',$b->id)); ?>" class="btn btn-info btn-sm">Xem chi tiết</a>
                <a href="<?php echo e(route('bookings.edit',$b->id)); ?>" class="btn btn-warning btn-sm">Chỉnh sửa</a>

                <?php if($b->status !== 'paid'): ?>
                <form action="<?php echo e(route('bookings.destroy',$b->id)); ?>"
                      method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-danger btn-sm">Xóa</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/bookings/index.blade.php ENDPATH**/ ?>