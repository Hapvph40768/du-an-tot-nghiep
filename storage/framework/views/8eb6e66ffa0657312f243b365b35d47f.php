<?php $__env->startSection('content-main'); ?>
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Lịch sử Ký gửi hàng hóa</h2>
            <a href="<?php echo e(route('customer.parcels.create')); ?>" class="bg-amber-500 hover:bg-amber-600 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                + Gửi hàng mới
            </a>
        </div>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm"><?php echo e(session('success')); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm"><?php echo e(session('error')); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($parcels->isEmpty()): ?>
                <div class="p-12 text-center text-gray-500">
                    <p class="mb-4 text-lg">Bạn chưa có đơn ký gửi nào.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-100 uppercase text-xs font-semibold text-gray-600 border-b">
                                <th class="p-4">Mã Đơn</th>
                                <th class="p-4">Tuyến đường</th>
                                <th class="p-4">Thông tin gửi/nhận</th>
                                <th class="p-4">Cân nặng</th>
                                <th class="p-4 text-right">Tổng tiền</th>
                                <th class="p-4 text-center">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $parcels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parcel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4 font-bold text-gray-800">#<?php echo e($parcel->id); ?></td>
                                    <td class="p-4 text-gray-700">
                                        <?php echo e($parcel->route->startLocation->name ?? 'N/A'); ?> 
                                        <span class="text-gray-400 mx-1">→</span> 
                                        <?php echo e($parcel->route->endLocation->name ?? 'N/A'); ?>

                                    </td>
                                    <td class="p-4 text-gray-700">
                                        <div><strong>Gửi:</strong> <?php echo e($parcel->sender_name); ?> (<?php echo e($parcel->sender_phone); ?>)</div>
                                        <div><strong>Nhận:</strong> <?php echo e($parcel->receiver_name); ?> (<?php echo e($parcel->receiver_phone); ?>)</div>
                                    </td>
                                    <td class="p-4 text-gray-700"><?php echo e($parcel->weight); ?> kg</td>
                                    <td class="p-4 text-amber-600 font-bold text-right"><?php echo e(number_format($parcel->price, 0, ',', '.')); ?>đ</td>
                                    <td class="p-4 text-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($parcel->status == 'pending'): ?>
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-bold inline-block">Chờ xử lý</span>
                                        <?php elseif($parcel->status == 'shipping'): ?>
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-bold inline-block">Đang giao</span>
                                        <?php elseif($parcel->status == 'completed'): ?>
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold inline-block">Đã nhận</span>
                                        <?php elseif($parcel->status == 'cancelled'): ?>
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-bold inline-block">Đã hủy</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-bold inline-block"><?php echo e($parcel->status); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\customer\parcels\index.blade.php ENDPATH**/ ?>