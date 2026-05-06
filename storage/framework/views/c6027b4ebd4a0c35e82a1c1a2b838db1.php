<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold">Danh sách Đặt vé</h1>
    <div class="flex flex-col md:flex-row gap-4">
        <a href="<?php echo e(route('staff.bookings.create')); ?>" class="px-6 py-2 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-500/20 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/></svg>
            Tạo Đơn Offline
        </a>
        <form action="<?php echo e(route('staff.bookings.index')); ?>" method="GET" class="flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Tên khách, số điện thoại..." class="px-4 py-2 border rounded-xl dark:bg-[#111111] dark:border-[#262626]">
            <select name="status" class="px-4 py-2 border rounded-xl dark:bg-[#111111] dark:border-[#262626]">
                <option value="">Tất cả trạng thái</option>
                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Chờ thanh toán</option>
                <option value="paid" <?php echo e(request('status') == 'paid' ? 'selected' : ''); ?>>Đã thanh toán</option>
                <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>Đã hủy</option>
            </select>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700">Lọc</button>
        </form>
    </div>
</div>

<div class="bg-white dark:bg-[#111111] rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626] overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 dark:bg-[#1a1a1a] text-xs uppercase opacity-40 font-bold">
            <tr>
                <th class="px-6 py-4 text-center">ID</th>
                <th class="px-6 py-4">Khách hàng</th>
                <th class="px-6 py-4">Chuyến xe</th>
                <th class="px-6 py-4 text-right">Tổng tiền</th>
                <th class="px-6 py-4 text-center">Trạng thái</th>
                <th class="px-6 py-4 text-center">Hành động</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#262626]">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <tr class="hover:bg-gray-50 dark:hover:bg-[#161616] transition-colors">
                    <td class="px-6 py-4 text-center font-medium opacity-60">#<?php echo e($booking->id); ?></td>
                    <td class="px-6 py-4">
                        <div class="font-bold"><?php echo e($booking->contact_name); ?></div>
                        <div class="text-xs opacity-60 mb-1"><?php echo e($booking->contact_phone); ?></div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->tickets->count() > 0): ?>
                            <div class="flex flex-wrap gap-1 mt-1">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $booking->tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <span class="px-1.5 py-0.5 bg-gray-100 dark:bg-[#222] border border-gray-200 dark:border-[#333] text-[10px] font-bold rounded"><?php echo e($ticket->seat->seat_number ?? '?'); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-sm"><?php echo e($booking->trip->route->startLocation->name); ?> &rarr; <?php echo e($booking->trip->route->endLocation->name); ?></div>
                        <div class="text-xs opacity-60"><?php echo e($booking->trip->trip_date); ?> | <?php echo e($booking->trip->departure_time); ?></div>
                    </td>
                    <td class="px-6 py-4 text-right font-bold text-blue-600">
                        <?php echo e(number_format($booking->total_amount)); ?>đ
                    </td>
                    <td class="px-6 py-4 text-center">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status == 'pending'): ?>
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-bold">Chờ thanh toán</span>
                        <?php elseif($booking->status == 'paid'): ?>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Đã thanh toán</span>
                        <?php else: ?>
                            <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-bold">Đã hủy</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="<?php echo e(route('staff.bookings.show', $booking)); ?>" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg text-blue-500" title="Xem chi tiết">
                                Xem
                            </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status == 'pending'): ?>
                                <form action="<?php echo e(route('staff.bookings.confirm', $booking)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" onclick="return confirm('Xác định đã thu tiền mặt của khách?')" class="px-3 py-1.5 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg text-sm font-bold transition-colors" title="Thu Tiền Mặt">
                                        Thu tiền
                                    </button>
                                </form>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center opacity-40 italic">Không có dữ liệu đặt vé phù hợp.</td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
    <div class="p-6 border-t border-[#e3e3e0] dark:border-[#262626]">
        <?php echo e($bookings->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.staff', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\staff\bookings\index.blade.php ENDPATH**/ ?>