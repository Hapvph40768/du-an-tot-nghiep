<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="view-transition" content="same-origin">
    <title><?php echo e($title ?? 'Nhà xe Mạnh Hùng - Trải nghiệm dịch vụ 5 sao'); ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite Tailwind CSS -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <?php echo $__env->make('layout.partials.translator', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-[#0a0a0a] text-white font-sans antialiased overflow-x-hidden min-h-screen flex flex-col" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
    
    <!-- Atmosphere Background -->
    <div class="fixed inset-0 -z-10 pointer-events-none bg-[#0a0a0a]">
        <div class="absolute top-[10%] left-[5%] w-[40%] h-[40%] rounded-full bg-[#ff5b24]/10 blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[10%] right-[5%] w-[30%] h-[30%] rounded-full bg-[#ffb800]/5 blur-[100px] animate-pulse" style="animation-delay: 2s"></div>
    </div>

    <!-- Header -->
    <?php echo $__env->make('layout.customer.blocks.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main Content -->
    <main class="flex-grow relative z-10 w-full">
        <?php echo $__env->yieldContent('content-main'); ?>
    </main>

    <!-- Footer -->
    <?php echo $__env->make('layout.customer.blocks.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('chatbox');

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1519968496-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    
    <script>
        lucide.createIcons();
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/layout/customer/CustomerLayout.blade.php ENDPATH**/ ?>