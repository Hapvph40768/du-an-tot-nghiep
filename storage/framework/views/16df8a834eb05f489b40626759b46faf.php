<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nhân Viên - <?php echo e(config('app.name')); ?></title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col p-6 lg:p-8">
    <header class="w-full lg:max-w-6xl mx-auto text-sm mb-6 pb-4 border-b border-[#e3e3e0] dark:border-[#262626]">
        <nav class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-6">
                <div class="font-bold text-lg text-blue-600 dark:text-blue-400">STAFF PORTAL</div>
                <div class="hidden lg:flex gap-4">
                    <a href="<?php echo e(route('staff.dashboard')); ?>" class="hover:text-blue-600 transition-colors <?php echo e(request()->routeIs('staff.dashboard') ? 'font-semibold border-b-2 border-blue-600' : ''); ?>">Tổng quan</a>
                    <a href="<?php echo e(route('staff.bookings.index')); ?>" class="hover:text-blue-600 transition-colors <?php echo e(request()->routeIs('staff.bookings.*') ? 'font-semibold border-b-2 border-blue-600' : ''); ?>">Đặt vé</a>
                    <a href="<?php echo e(route('staff.trips.index')); ?>" class="hover:text-blue-600 transition-colors <?php echo e(request()->routeIs('staff.trips.*') ? 'font-semibold border-b-2 border-blue-600' : ''); ?>">Chuyến xe</a>
                    <a href="<?php echo e(route('staff.checkin.index')); ?>" class="hover:text-blue-600 transition-colors <?php echo e(request()->routeIs('staff.checkin.index') ? 'font-semibold border-b-2 border-blue-600' : ''); ?>">Check-in</a>
                    <a href="<?php echo e(route('staff.parking.index')); ?>" class="hover:text-blue-600 transition-colors <?php echo e(request()->routeIs('staff.parking.*') ? 'font-semibold border-b-2 border-blue-600' : ''); ?>">Bãi xe</a>
                </div>
            </div>
            <div class="flex items-center gap-4 text-right">
                <a href="<?php echo e(route('staff.profile.index')); ?>" class="flex flex-col group">
                    <span class="text-[10px] opacity-40 font-bold uppercase leading-none group-hover:text-blue-600 transition-all">Nhân viên trực ca</span>
                    <span class="text-xs font-bold group-hover:text-blue-600 transition-all border-b border-transparent group-hover:border-blue-600"><?php echo e(Auth::user()->name); ?></span>
                </a>
                <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?>
                    <button type="submit" class="text-red-500 hover:text-red-600 text-xs font-medium">Đăng xuất</button>
                </form>
            </div>
        </nav>
    </header>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="lg:max-w-6xl mx-auto w-full mb-4 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
        <div class="lg:max-w-6xl mx-auto w-full mb-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <main class="w-full lg:max-w-6xl mx-auto grow">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="w-full lg:max-w-6xl mx-auto text-center py-8 text-xs opacity-40">
        &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?> - Staff Operations System
    </footer>
</body>
</html>
<?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\layout\staff.blade.php ENDPATH**/ ?>