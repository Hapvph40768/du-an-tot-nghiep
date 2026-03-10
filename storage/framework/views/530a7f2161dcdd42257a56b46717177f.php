<header class="top-header">
    <div class="header-title">
        <h1><?php echo $__env->yieldContent('header-title', 'Tổng quan'); ?></h1>
        <p><?php echo $__env->yieldContent('header-subtitle', 'Chào mừng trở lại!'); ?></p>
    </div>

    <div class="header-actions">
        <div class="search-box">
            <i class='bx bx-search'></i>
            <input type="text" placeholder="Tìm kiếm...">
        </div>

        <button class="notif-btn">
            <i class='bx bx-bell'></i>
            <div class="notif-badge"></div>
        </button>

        <!-- Logout -->
        <?php if(auth()->guard()->check()): ?>
            <form action="<?php echo e(route('logout')); ?>" method="POST" onsubmit="return confirm('Bạn có chắc muốn đăng xuất?')">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-btn">
                    <i class='bx bx-log-out'></i>
                    Đăng xuất
                </button>
            </form>
        <?php endif; ?>

    </div>
</header>
<?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/layout/admin/blocks/header.blade.php ENDPATH**/ ?>