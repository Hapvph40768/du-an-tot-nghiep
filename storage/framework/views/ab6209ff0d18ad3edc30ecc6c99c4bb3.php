<?php $__env->startSection('title', 'Đăng ký tài khoản'); ?>

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
    <form method="post" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label class="form-label">Họ và tên</label>
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Nguyễn Văn A" required>
                <i class='bx bx-id-card input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <div class="input-group">
                <input type="email" name="email" class="form-control" placeholder="example@manhhung.com" required>
                <i class='bx bx-envelope input-icon'></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Số điện thoại</label>
            <div class="input-group">
                <input type="tel" name="phone" class="form-control" placeholder="0912 345 678" required>
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

        <button type="submit" class="btn-primary" style="margin-top: 16px;">
            Đăng ký tài khoản
        </button>

        <div class="auth-links" style="justify-content: center; margin-top: 24px;">
            <span>Đã có tài khoản? <a href="<?php echo e(route('login')); ?>" class="text-link">Đăng nhập</a></span>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.AuthLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/auth/register.blade.php ENDPATH**/ ?>