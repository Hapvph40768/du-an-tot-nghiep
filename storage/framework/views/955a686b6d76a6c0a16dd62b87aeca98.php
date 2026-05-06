<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - <?php echo e(config('app.name')); ?></title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col p-6 lg:p-8">
    <header class="w-full lg:max-w-4xl mx-auto text-sm mb-6">
        <nav class="flex items-center justify-between gap-4">
            <div class="font-medium">Quản lý Hệ Thống</div>
            <div class="flex gap-4">
                <a href="<?php echo e(route('admin.dashboard.index')); ?>" class="underline underline-offset-4">Dashboard</a>
                <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?>
                    <button type="submit" class="opacity-70 hover:opacity-100">Đăng xuất</button>
                </form>
            </div>
        </nav>
    </header>

    <main class="w-full lg:max-w-4xl mx-auto grow">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\layout\admin.blade.php ENDPATH**/ ?>