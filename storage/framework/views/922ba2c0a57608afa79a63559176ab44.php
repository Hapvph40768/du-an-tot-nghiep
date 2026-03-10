<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?></title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
    
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <?php echo $__env->make('layout.admin.blocks.aside', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Header -->
            <?php echo $__env->make('layout.admin.blocks.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <!-- Page Content -->
            <div class="content-body">
                <?php echo $__env->yieldContent('content-main'); ?>
            </div>
        </main>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/layout/admin/AdminLayout.blade.php ENDPATH**/ ?>