<?php $__env->startSection('title', 'Quên mật khẩu'); ?>

<?php $__env->startSection('content'); ?>
    <div style="text-align: center; margin-bottom: 24px;">
        <h3 style="margin-bottom: 8px; color: var(--text-primary);">Khôi phục mật khẩu</h3>
        <p style="color: var(--text-secondary); font-size: 14px;">
            Vui lòng nhập địa chỉ email bạn đã sử dụng để đăng ký. Chúng tôi sẽ gửi một liên kết để thiết lập lại mật khẩu.
        </p>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-1'></i>
            <?php echo e(session('status')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
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

    <form method="post" action="<?php echo e(route('password.email')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label class="form-label">Email của bạn</label>
            <div class="input-group">
                <input type="email" name="email" class="form-control" 
                       placeholder="phamvana@gmail.com" value="<?php echo e(old('email')); ?>" 
                       required autofocus>
                <i class='bx bx-envelope input-icon'></i>
            </div>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; margin-top: 16px;">
            Gửi liên kết khôi phục
        </button>

        <div class="auth-links" style="justify-content: center; margin-top: 32px;">
            <span><a href="<?php echo e(route('login')); ?>" class="text-link"><i class='bx bx-arrow-back'></i> Quay lại đăng nhập</a></span>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.AuthLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>