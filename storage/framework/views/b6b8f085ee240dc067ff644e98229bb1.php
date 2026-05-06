<?php $__env->startSection('content'); ?>
<div class="flex items-center gap-4 mb-8">
    <a href="<?php echo e(route('staff.trips.index')); ?>" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/></svg>
    </a>
    <h1 class="text-2xl font-bold">Chi tiết Chuyến xe: <?php echo e($trip->route->startLocation->name); ?> &rarr; <?php echo e($trip->route->endLocation->name); ?></h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white dark:bg-[#111111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <h3 class="text-xs font-bold uppercase opacity-40 mb-6 tracking-widest">Sơ đồ ghế</h3>
            
            <div class="max-w-[200px] mx-auto p-4 bg-gray-50 dark:bg-[#1a1a1a] rounded-2xl border-4 border-gray-200 dark:border-[#262626] relative">
                <div class="absolute top-2 right-4 w-6 h-6 bg-gray-400 rounded-lg flex items-center justify-center text-[10px] text-white font-bold">Vô lăn</div>
                
                <div class="grid grid-cols-2 gap-4 mt-12 pb-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl font-bold text-sm shadow-sm transition-all
                            <?php echo e(in_array($seat->id, $occupiedSeatIds) 
                                ? 'bg-blue-600 text-white shadow-blue-500/50 scale-105' 
                                : 'bg-white dark:bg-[#262626] border border-gray-200 dark:border-[#333] opacity-60'); ?>">
                            <?php echo e($seat->seat_number); ?>

                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>

            <div class="mt-8 space-y-2">
                <div class="flex items-center gap-3 text-sm">
                    <div class="w-4 h-4 bg-blue-600 rounded"></div>
                    <span class="font-medium">Đã đặt (<?php echo e(count($occupiedSeatIds)); ?>)</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    <div class="w-4 h-4 bg-white border border-gray-300 rounded"></div>
                    <span class="opacity-60">Còn trống (<?php echo e(count($seats) - count($occupiedSeatIds)); ?>)</span>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white dark:bg-[#111111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <h2 class="text-xl font-bold mb-6">Thông tin vận hành</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="text-xs font-bold uppercase opacity-40 mb-2">Phương tiện</div>
                    <div class="text-lg font-bold"><?php echo e($trip->vehicle->license_plate ?? 'N/A'); ?></div>
                    <div class="text-sm opacity-60"><?php echo e($trip->vehicle->type ?? ''); ?></div>
                </div>
                <div>
                    <div class="text-xs font-bold uppercase opacity-40 mb-2">Tài xế</div>
                    <div class="text-lg font-bold"><?php echo e($trip->driver->name ?? 'N/A'); ?></div>
                    <div class="text-sm opacity-60"><?php echo e($trip->driver->phone ?? ''); ?></div>
                </div>
                <div>
                    <div class="text-xs font-bold uppercase opacity-40 mb-2">Giá vé</div>
                    <div class="text-lg font-bold text-blue-600"><?php echo e(number_format($trip->price)); ?>đ</div>
                </div>
                <div>
                    <div class="text-xs font-bold uppercase opacity-40 mb-2">Trạng thái chuyến</div>
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase"><?php echo e($trip->status); ?></span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-[#111111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <h2 class="text-xl font-bold mb-6">Danh sách Vé phát hành</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-xs uppercase opacity-40 font-bold">
                        <tr>
                            <th class="pb-4">Ghế</th>
                            <th class="pb-4">Mã Vé</th>
                            <th class="pb-4">Khách hàng</th>
                            <th class="pb-4">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#262626]">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trip->tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr>
                                <td class="py-4 font-bold text-blue-600 text-lg">#<?php echo e($ticket->seat->seat_number); ?></td>
                                <td class="py-4 font-mono text-sm opacity-60"><?php echo e($ticket->ticket_code); ?></td>
                                <td class="py-4 font-medium"><?php echo e($ticket->booking->contact_name); ?></td>
                                <td class="py-4">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ticket->status === 'used'): ?>
                                        <span class="text-green-600 font-bold text-xs uppercase underline">Đã lên xe</span>
                                    <?php else: ?>
                                        <span class="text-orange-500 font-bold text-xs uppercase italic opacity-60">Chờ hành khách</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.staff', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\staff\trips\show.blade.php ENDPATH**/ ?>