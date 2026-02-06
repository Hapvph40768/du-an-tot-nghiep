<?php $__env->startSection('content-main'); ?>

<div class="top-header">
    <div class="header-title">
        <h1>Tạo Tuyến Xe Mới</h1>
        <p>Thêm một tuyến xe mới vào hệ thống</p>
    </div>
</div>

<div style="max-width: 800px;">
    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">
        <?php if($errors->any()): ?>
            <div style="background-color: #fee; border: 1px solid #fcc; color: #c33; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
                <strong>Lỗi:</strong>
                <ul style="margin: 8px 0 0; padding-left: 20px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('routes.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Điểm bắt đầu <span style="color: #ff5b24;">*</span></label>
                    <select name="start_location_id" style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" required>
                        <option value="">-- Chọn điểm --</option>
                        <?php $__empty_1 = true; $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <option value="<?php echo e($location->id); ?>" <?php if(old('start_location_id') == $location->id): echo 'selected'; endif; ?>><?php echo e($location->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <option value="" disabled>Chưa có địa điểm</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Điểm đến <span style="color: #ff5b24;">*</span></label>
                    <select name="end_location_id" style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" required>
                        <option value="">-- Chọn điểm --</option>
                        <?php $__empty_1 = true; $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <option value="<?php echo e($location->id); ?>" <?php if(old('end_location_id') == $location->id): echo 'selected'; endif; ?>><?php echo e($location->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <option value="" disabled>Chưa có địa điểm</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Khoảng cách (km) <span style="color: #ff5b24;">*</span></label>
                    <input type="number" name="distance_km" style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" value="<?php echo e(old('distance_km')); ?>" min="1" required>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Thời gian dự kiến (phút) <span style="color: #ff5b24;">*</span></label>
                    <input type="number" name="estimated_time" style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" value="<?php echo e(old('estimated_time')); ?>" min="1" required>
                </div>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="background-color: #ff5b24; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px;">Tạo tuyến xe</button>
                <a href="<?php echo e(route('routes.index')); ?>" style="display: inline-flex; align-items: center; background-color: #f0f2f5; color: #333; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">Hủy</a>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/routes/create.blade.php ENDPATH**/ ?>