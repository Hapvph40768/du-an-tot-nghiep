<?php $__env->startSection('title', 'Đăng nhập'); ?>

<?php $__env->startSection('content'); ?>
    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <form method="post" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label class="form-label">Email</label>
            <div class="input-group">
                <input type="text" name="email" class="form-control" placeholder="phamvana@gmai.com" required
                    autofocus>
                <i class='bx bx-user input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Mật khẩu</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                <i class='bx bx-lock-alt input-icon'></i>
            </div>
        </div>

        <div class="auth-links" style="margin-bottom: 24px;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="remember">
                <span style="color: var(--text-secondary);">Ghi nhớ đăng nhập</span>
            </label>
            <a href="#">Quên mật khẩu?</a>
        </div>

        <button type="submit" class="btn-primary">
            Đăng nhập hệ thống
        </button>

        <div class="auth-links" style="justify-content: center; margin-top: 32px;">
            <span>Chưa có tài khoản? <a href="<?php echo e(route('register')); ?>" class="text-link">Đăng ký ngay</a></span>
        </div>

    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.AuthLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/auth/login.blade.php ENDPATH**/ ?>