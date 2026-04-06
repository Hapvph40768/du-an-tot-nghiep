<?php $__env->startSection('title', 'Thêm tài xế mới'); ?>

<?php $__env->startSection('content-main'); ?>

    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);">

        <form action="<?php echo e(route('admin.drivers.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Tên tài xế <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="text" name="name"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="<?php echo e(old('name')); ?>" required autofocus>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Số điện thoại <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="text" name="phone"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="<?php echo e(old('phone')); ?>" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Email liên hệ <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="text" name="email"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="<?php echo e(old('email')); ?>" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Số bằng lái <span style="color: #ff5b24;">*</span>
                    </label>
                    <input type="text" name="license_number"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="<?php echo e(old('license_number')); ?>" required>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['license_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Số năm kinh nghiệm
                    </label>
                    <input type="number" name="experience_years"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        value="<?php echo e(old('experience_years')); ?>" min="0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['experience_years'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                        Trạng thái <span style="color: #ff5b24;">*</span>
                    </label>
                    <select name="status"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
                        required>
                        <option value="active" <?php echo e(old('status', 'active') == 'active' ? 'selected' : ''); ?>>Đang hoạt
                            động</option>
                        <option value="busy" <?php echo e(old('status') == 'busy' ? 'selected' : ''); ?>>Đang chạy</option>
                        <option value="inactive" <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?>>Đã nghỉ</option>
                    </select>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div style="color: #c33; font-size: 12px; margin-top: 4px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">
                    Thông tin cá nhân (tùy chọn)
                </label>
                <textarea name="personal_info" rows="4"
                    style="width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; resize: vertical;"><?php echo e(old('personal_info')); ?></textarea>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['personal_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div style="color: #c33; font-size: 12px; margin-top: 4px;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-start;">
                <button type="submit"
                    style="background-color: #ff5b24; color: white; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px;">
                    Thêm tài xế
                </button>
                <a href="<?php echo e(route('admin.drivers.index')); ?>"
                    style="display: inline-flex; align-items: center; background-color: #f0f2f5; color: #333; padding: 10px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; text-decoration: none;">
                    Hủy
                </a>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/drivers/create.blade.php ENDPATH**/ ?>