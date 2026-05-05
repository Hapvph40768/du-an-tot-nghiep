

<?php $__env->startSection('title', 'Đăng ký tài khoản'); ?>

<?php $__env->startSection('content'); ?>
     <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul class="mb-0 ps-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <li><?php echo e($error); ?></li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <form method="post" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label class="form-label">Họ và tên</label>
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Nguyễn Văn A" value="<?php echo e(old('name')); ?>" required>
                <i class='bx bx-id-card input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label"><?php echo e(__('email')); ?></label>
            <div class="input-group">
                <input type="email" name="email" class="form-control" placeholder="nguyenvana@gmail.com" value="<?php echo e(old('email')); ?>" required>
                <i class='bx bx-envelope input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Số điện thoại</label>
            <div class="input-group">
                <input type="text" name="phone" class="form-control" placeholder="0987654321" value="<?php echo e(old('phone')); ?>" required>
                <i class='bx bx-phone input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Mật khẩu</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                <i class='bx bx-lock-alt input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label"><?php echo e(__('confirm')); ?> mật khẩu</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                <i class='bx bx-check-shield input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Bạn đăng ký với vai trò gì?</label>
            <div class="input-group">
                <select name="role" class="form-control" required style="padding-left: 45px; appearance: auto;">
                    <option value="customer" <?php echo e(old('role') == 'customer' ? 'selected' : ''); ?>>Khách hàng</option>
                    <option value="driver" <?php echo e(old('role') == 'driver' ? 'selected' : ''); ?>><?php echo e(__('drivers')); ?></option>
                </select>
                <i class='bx bx-briefcase input-icon'></i>
            </div>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; margin-top: 16px;">
            Tạo tài khoản mới
        </button>

        <div class="auth-links" style="justify-content: center; margin-top: 32px;">
            <span><?php echo e(__('already_active')); ?><a href="<?php echo e(route('login')); ?>" class="text-link"><?php echo e(__('login')); ?></a></span>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.AuthLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\code\laragon\www\du-an-tot-nghiep\resources\views/auth/register.blade.php ENDPATH**/ ?>