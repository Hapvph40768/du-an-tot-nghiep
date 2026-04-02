<?php $__env->startSection('page-title', 'Doanh thu'); ?>

<?php $__env->startSection('content-main'); ?>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Dashboard Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-indigo-500 rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-blue-100 font-medium mb-1">Tổng doanh thu</p>
                    <h3 class="text-4xl font-bold"><?php echo e(number_format($totalRevenue, 0, ',', '.')); ?> VNĐ</h3>
                </div>
                <i class='bx bx-coin-stack absolute -right-4 -bottom-4 text-8xl text-white opacity-20'></i>
            </div>
            
            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm relative overflow-hidden flex items-center">
                <div>
                    <p class="text-gray-500 font-medium mb-1">Tổng chuyến hoàn thành</p>
                    <h3 class="text-4xl font-bold text-gray-800"><?php echo e($trips->total()); ?></h3>
                </div>
                <i class='bx bx-bus absolute -right-4 -bottom-4 text-8xl text-gray-100'></i>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trips->isEmpty()): ?>
            <div class="bg-white rounded-3xl p-16 text-center border border-gray-100 shadow-sm">
                <i class='bx bx-wallet text-7xl text-gray-200 mx-auto'></i>
                <p class="mt-6 text-xl text-gray-400">Chưa có dữ liệu doanh thu.</p>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 sm:p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                        <i class='bx bx-bar-chart-alt-2 text-blue-500'></i> Doanh thu theo chuyến
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-gray-100 text-gray-400 text-xs uppercase tracking-wider">
                                <th class="py-4 px-6 font-semibold">Ngày khởi hành</th>
                                <th class="py-4 px-6 font-semibold">Tuyến đường</th>
                                <th class="py-4 px-6 font-semibold text-center">Số khách</th>
                                <th class="py-4 px-6 font-semibold text-right">Doanh thu (VNĐ)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php
                                    $passengerCount = $trip->tickets->where('status', '!=', 'cancelled')->count();
                                    
                                    $bookings = $trip->tickets->where('status', '!=', 'cancelled')->map(function($t) {
                                        return $t->booking;
                                    })->filter()->unique('id');
                                    
                                    $tripRevenue = $bookings->filter(function($b) {
                                        return $b->payment && $b->payment->status === 'success';
                                    })->sum(function($b) { 
                                        return $b->payment->amount; 
                                    });
                                ?>
                                <tr class="hover:bg-blue-50/30 transition duration-150">
                                    <td class="py-5 px-6">
                                        <div class="font-bold text-gray-900"><?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('H:i')); ?></div>
                                        <div class="text-xs text-gray-500 mt-1"><?php echo e(\Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y')); ?></div>
                                    </td>
                                    <td class="py-5 px-6">
                                        <p class="font-medium text-gray-800 flex items-center gap-2">
                                            <?php echo e($trip->route->departureLocation->name ?? 'N/A'); ?> 
                                            <i class='bx bx-right-arrow-alt text-blue-400'></i> 
                                            <?php echo e($trip->route->destinationLocation->name ?? 'N/A'); ?>

                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">Biển số: <?php echo e($trip->vehicle->license_plate ?? 'N/A'); ?></p>
                                    </td>
                                    <td class="py-5 px-6 text-center">
                                        <span class="inline-flex items-center justify-center bg-gray-100 text-gray-700 px-3 py-1 rounded-xl text-sm font-bold min-w-[2.5rem]">
                                            <?php echo e($passengerCount); ?>

                                        </span>
                                    </td>
                                    <td class="py-5 px-6 text-right font-bold text-emerald-600 text-lg">
                                        +<?php echo e(number_format($tripRevenue, 0, ',', '.')); ?>

                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                <?php echo e($trips->links()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.assistant.AssistantLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/assistant/trips/revenue.blade.php ENDPATH**/ ?>