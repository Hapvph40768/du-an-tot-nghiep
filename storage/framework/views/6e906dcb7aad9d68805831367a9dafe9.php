<?php $__env->startSection('content-main'); ?>
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Lịch sử đặt vé</h2>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm"><?php echo e(session('error')); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bookings->isEmpty()): ?>
                <div class="p-12 text-center text-gray-500">
                    <p class="mb-4 text-lg">Bạn chưa có đơn đặt vé nào.</p>
                    <a href="<?php echo e(route('customer.home')); ?>" class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-medium py-2 px-6 rounded-lg transition-colors">Đặt vé ngay</a>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-100 uppercase text-xs font-semibold text-gray-600 border-b">
                                <th class="p-4">Mã ĐH</th>
                                <th class="p-4">Tuyến đường</th>
                                <th class="p-4">Khởi hành</th>
                                <th class="p-4 text-right">Tổng tiền</th>
                                <th class="p-4 text-center">Trạng thái</th>
                                <th class="p-4 text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4 font-bold text-gray-800">#<?php echo e($booking->id); ?></td>
                                    <td class="p-4 text-gray-700">
                                        <?php echo e($booking->trip->route->departureLocation->name ?? '...'); ?> 
                                        <span class="text-gray-400 mx-1">→</span> 
                                        <?php echo e($booking->trip->route->destinationLocation->name ?? '...'); ?>

                                    </td>
                                    <td class="p-4 text-gray-700">
                                        <?php echo e(\Carbon\Carbon::parse($booking->trip->trip_date)->format('d/m/Y')); ?> 
                                        <br>
                                        <span class="font-medium text-amber-600"><?php echo e(\Carbon\Carbon::parse($booking->trip->departure_time)->format('H:i')); ?></span>
                                    </td>
                                    <td class="p-4 text-amber-600 font-bold text-right"><?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?>đ</td>
                                    <td class="p-4 text-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status == 'pending'): ?>
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-bold inline-block">Đang chờ</span>
                                        <?php elseif($booking->status == 'paid'): ?>
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold inline-block">Đã thanh toán</span>
                                        <?php elseif($booking->status == 'cancelled'): ?>
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-bold inline-block">Đã hủy</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-bold inline-block"><?php echo e($booking->status); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="<?php echo e(route('customer.bookings.show', $booking->id)); ?>" class="text-blue-600 hover:text-blue-800 font-medium hover:underline inline-block">Chi tiết</a>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/customer/bookings/index.blade.php ENDPATH**/ ?>