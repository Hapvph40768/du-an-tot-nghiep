<?php $__env->startSection('page-title', 'Báo cáo doanh thu'); ?>

<?php $__env->startSection('content-main'); ?>
    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div class="flex items-start gap-4">
                <a href="<?php echo e(route('driver.home')); ?>" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 text-gray-500 hover:bg-amber-100 hover:text-amber-600 transition-colors mt-1">
                    <i class='bx bx-chevron-left text-2xl'></i>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Tổng quan Doanh Thu</h2>
                    <p class="text-gray-500 mt-1">Dựa trên các chuyến xe đã được quản lý bởi bạn.</p>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-3xl p-6 text-white shadow-lg sm:min-w-[300px]">
                <p class="text-white/80 font-medium text-sm mb-1 uppercase tracking-wider">Tổng doanh thu các chuyến</p>
                <div class="text-4xl font-bold tracking-tight">
                    <?php echo e(number_format($totalRevenue)); ?><span class="text-2xl opacity-80 ml-1">đ</span>
                </div>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($tripStats)): ?>
            <div class="bg-white rounded-3xl p-16 text-center shadow-sm border border-gray-100">
                <i class='bx bx-wallet text-7xl text-gray-200 mx-auto'></i>
                <p class="mt-6 text-xl text-gray-400">Bạn chưa có doanh thu từ các chuyến đi nào.</p>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-lg text-gray-800">Chi tiết doanh thu theo chuyến</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full min-w-full">
                        <thead>
                            <tr class="bg-white border-b border-gray-100">
                                <th class="text-left py-5 px-8 font-medium text-gray-500 uppercase tracking-wider text-xs">Mã chuyến & Lộ trình</th>
                                <th class="text-left py-5 px-8 font-medium text-gray-500 uppercase tracking-wider text-xs">Ngày khởi hành</th>
                                <th class="text-center py-5 px-8 font-medium text-gray-500 uppercase tracking-wider text-xs">Số vé đã thanh toán</th>
                                <th class="text-right py-5 px-8 font-medium text-gray-500 uppercase tracking-wider text-xs">Tổng thu (VNĐ)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tripStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php
                                    $trip = $stat['trip'];
                                ?>
                                <tr class="hover:bg-gray-50/80 transition-colors">
                                    <td class="py-5 px-8">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-600 font-bold">
                                                <?php echo e($trip->id); ?>

                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900">
                                                    <?php echo e($trip->route->departureLocation->name ?? 'N/A'); ?> 
                                                    <i class='bx bx-right-arrow-alt text-gray-400 mx-1'></i> 
                                                    <?php echo e($trip->route->destinationLocation->name ?? 'N/A'); ?>

                                                </p>
                                                <p class="text-xs text-gray-500 mt-1">Biển số: <?php echo e($trip->vehicle->license_plate ?? 'N/A'); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-5 px-8">
                                        <p class="font-medium text-gray-800"><?php echo e(\Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y')); ?></p>
                                        <p class="text-xs text-gray-500 mt-1"><?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('H:i')); ?></p>
                                    </td>
                                    <td class="py-5 px-8 text-center text-gray-600">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 font-semibold text-gray-700">
                                            <?php echo e($stat['bookings_count']); ?>

                                        </span>
                                    </td>
                                    <td class="py-5 px-8 text-right">
                                        <span class="font-bold text-gray-900 text-lg">
                                            <?php echo e(number_format($stat['revenue'], 0, ',', '.')); ?>đ
                                        </span>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.driver.DriverLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/driver/revenue/index.blade.php ENDPATH**/ ?>