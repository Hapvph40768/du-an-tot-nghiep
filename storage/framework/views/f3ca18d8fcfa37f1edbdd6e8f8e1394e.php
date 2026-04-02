<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold">Lịch trình Chuyến xe</h1>
    <form action="<?php echo e(route('staff.trips.index')); ?>" method="GET" class="flex gap-2">
        <input type="date" name="date" value="<?php echo e(request('date', now()->format('Y-m-d'))); ?>" class="px-4 py-2 border rounded-xl dark:bg-[#111111] dark:border-[#262626]">
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700">Lọc ngày</button>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
        <div class="bg-white dark:bg-[#111111] p-6 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626] hover:border-blue-500 transition-colors group">
            <div class="flex justify-between items-start mb-4">
                <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold"><?php echo e($trip->vehicle->license_plate ?? 'BKS-XXX'); ?></span>
                <span class="text-xs opacity-40 font-bold uppercase tracking-widest"><?php echo e($trip->trip_date); ?></span>
            </div>
            
            <div class="flex items-center gap-4 mb-6">
                <div class="text-center">
                    <div class="text-xl font-black"><?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('H:i')); ?></div>
                    <div class="text-xs opacity-40 font-bold uppercase"><?php echo e($trip->route->startLocation->name); ?></div>
                </div>
                <div class="grow flex flex-col items-center">
                    <div class="w-full h-px bg-dash border-t-2 border-dashed border-[#e3e3e0] dark:border-[#262626] relative">
                        <div class="absolute -top-1.5 left-1/2 -translate-x-1/2 w-3 h-3 bg-blue-600 rounded-full shadow-lg shadow-blue-500/50"></div>
                    </div>
                    <div class="text-[10px] opacity-40 font-bold mt-1">SƠ ĐỒ GHẾ</div>
                </div>
                <div class="text-center">
                    <div class="text-xl font-black text-gray-400 group-hover:text-blue-600 transition-colors"><?php echo e(\Carbon\Carbon::parse($trip->arrival_time)->format('H:i')); ?></div>
                    <div class="text-xs opacity-40 font-bold uppercase"><?php echo e($trip->route->endLocation->name); ?></div>
                </div>
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-[#e3e3e0] dark:border-[#262626]">
                <div>
                    <div class="text-xs opacity-40 font-bold">TÀI XẾ</div>
                    <div class="text-sm font-bold"><?php echo e($trip->driver->name ?? 'Chưa gán'); ?></div>
                </div>
                <a href="<?php echo e(route('staff.trips.show', $trip)); ?>" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-sm font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all">Chi tiết</a>
            </div>
        </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <div class="col-span-full p-20 text-center opacity-40 italic">Không có chuyến xe nào trong ngày này.</div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<div class="mt-8">
    <?php echo e($trips->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.staff', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/staff/trips/index.blade.php ENDPATH**/ ?>