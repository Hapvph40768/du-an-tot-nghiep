

<?php $__env->startSection('content-main'); ?>
<h3 class="mb-4">Thêm Booking</h3>

<form action="<?php echo e(route('bookings.store')); ?>" method="POST" class="w-50">
    <?php echo csrf_field(); ?>

    
    <div class="mb-3">
        <label>Khách hàng</label>
        <select name="user_id" class="form-select">
            <option value="">-- Chọn khách hàng --</option>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($user->id); ?>"
                    <?php echo e(old('user_id') == $user->id ? 'selected' : ''); ?>>
                    <?php echo e($user->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="text-danger"><?php echo e($message); ?></small>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div class="mb-3">
        <label>Chuyến xe</label>
        <select name="trip_id" class="form-select">
            <option value="">-- Chọn chuyến --</option>
            <?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($trip->id); ?>"
                    <?php echo e(old('trip_id') == $trip->id ? 'selected' : ''); ?>>
                    Chuyến #<?php echo e($trip->id); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['trip_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="text-danger"><?php echo e($message); ?></small>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div class="mb-3">
        <label>Điểm đón</label>
        <select name="pickup_point_id" class="form-select">
            <option value="">-- Chọn điểm đón --</option>
            <?php $__currentLoopData = $pickupPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($point->id); ?>"
                    <?php echo e(old('pickup_point_id') == $point->id ? 'selected' : ''); ?>>
                    <?php echo e($point->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['pickup_point_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="text-danger"><?php echo e($message); ?></small>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div class="mb-3">
        <label>Tổng tiền</label>
        <input type="number" step="0.01" name="total_amount"
               value="<?php echo e(old('total_amount')); ?>"
               class="form-control">
    </div>

    
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-select">
            <option value="pending" <?php echo e(old('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
            <option value="paid" <?php echo e(old('status') == 'paid' ? 'selected' : ''); ?>>Paid</option>
            <option value="cancelled" <?php echo e(old('status') == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
        </select>
    </div>

    <button class="btn btn-primary">Lưu</button>
    <a href="<?php echo e(route('bookings.index')); ?>" class="btn btn-secondary">Quay lại</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/bookings/create.blade.php ENDPATH**/ ?>