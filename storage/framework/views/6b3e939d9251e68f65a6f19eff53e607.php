<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Đăng nhập'); ?> - Mạnh Hùng </title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">   
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/auth.css')); ?>">
</head>
<body>
    <div class="auth-container">
        <!-- Decoration Banner (Left) -->
        <div class="auth-banner">
            <div class="banner-content">
                <h2>Cổng truy cập hệ thống đặt vé Mạnh Hùng<br>Hiệu quả & Chuyên nghiệp</h2>
                <p>Chào mừng bạn đến với nền tảng đặt vé xe khách Mạnh Hùng.</p>
            </div>
            <div class="glass-shape"></div>
            <div class="glass-shape shape-2"></div>
        </div>

        <!-- Form Section (Right) -->
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="brand-header">
                    <div class="logo-icon">
                        <i class='bx bx-transfer-alt'></i>
                    </div>
                    <h1>Mạnh Hùng</h1>
                </div>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
            
            <div class="auth-footer">
                <p>&copy; 2026 Mạnh Hùng Transport. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/layout/AuthLayout.blade.php ENDPATH**/ ?>