<?php $__env->startSection('page-title', 'Lịch sử chuyến xe'); ?>

<?php $__env->startSection('content-main'); ?>
    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-4">
                <a href="<?php echo e(route('driver.home')); ?>" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 text-gray-500 hover:bg-amber-100 hover:text-amber-600 transition-colors">
                    <i class='bx bx-chevron-left text-2xl'></i>
                </a>
                <h2 class="text-2xl font-bold text-gray-800">Lịch sử chuyến xe</h2>
            </div>
            <a href="<?php echo e(route('driver.trips.index')); ?>" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition flex items-center gap-2">
                <i class='bx bx-bus'></i> Chuyến sắp chạy
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-8">
             <div class="flex flex-wrap items-center gap-4">
                <label class="font-medium text-gray-600 block">Bộ lọc trạng thái:</label>
                <div class="flex flex-wrap gap-2" id="status-filter">
                    <button onclick="applyHistoryFilters('')" data-status=""
                        class="history-status-btn px-5 py-2 rounded-2xl text-sm font-medium transition-all bg-amber-500 text-white shadow">
                        Tất cả
                    </button>
                    <button onclick="applyHistoryFilters('completed')" data-status="completed"
                        class="history-status-btn px-5 py-2 rounded-2xl text-sm font-medium transition-all border border-gray-200 hover:border-gray-300">
                        Hoàn thành
                    </button>
                    <button onclick="applyHistoryFilters('broken')" data-status="broken"
                        class="history-status-btn px-5 py-2 rounded-2xl text-sm font-medium transition-all border border-gray-200 hover:border-red-300">
                        Hỏng / Gián đoạn
                    </button>
                    <button onclick="applyHistoryFilters('cancelled')" data-status="cancelled"
                        class="history-status-btn px-5 py-2 rounded-2xl text-sm font-medium transition-all border border-gray-200 hover:border-red-300">
                        Đã hủy
                    </button>
                </div>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trips->isEmpty()): ?>
            <div class="bg-white rounded-3xl p-16 text-center">
                <i class='bx bx-history text-7xl text-gray-200 mx-auto'></i>
                <p class="mt-6 text-xl text-gray-400">Bạn chưa có lịch sử chuyến xe nào.</p>
            </div>
        <?php else: ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="history-container">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="history-card bg-white rounded-3xl overflow-hidden border border-gray-100 hover:border-amber-200 hover:shadow-xl transition-all duration-300 opacity-80 hover:opacity-100"
                        data-status="<?php echo e($trip->status); ?>">

                        <div class="h-1.5 bg-gray-400"></div>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <span
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-600 rounded-2xl text-sm font-semibold">
                                        <i class='bx bx-time-five'></i>
                                        <?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('H:i')); ?>

                                    </span>
                                    <p class="text-xs text-gray-500 mt-2">
                                        <?php echo e(\Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y')); ?>

                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs text-gray-500">Biển số</span>
                                    <p class="font-semibold text-gray-800 mt-0.5">
                                        <?php echo e($trip->vehicle->license_plate ?? 'Chưa gán'); ?>

                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 mb-8">
                                <div class="flex-1">
                                    <p class="font-bold text-xl text-gray-900 leading-tight">
                                        <?php echo e($trip->route->departureLocation->name ?? 'N/A'); ?>

                                    </p>
                                </div>
                                <div class="text-gray-400 text-4xl -mt-2">
                                    <i class='bx bx-right-arrow-alt'></i>
                                </div>
                                <div class="flex-1 text-right">
                                    <p class="font-bold text-xl text-gray-900 leading-tight">
                                        <?php echo e($trip->route->destinationLocation->name ?? 'N/A'); ?>

                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xl font-semibold text-gray-600">
                                        <?php echo e($trip->tickets->where('status', '!=', 'cancelled')->count()); ?>

                                    </span>
                                    <span class="text-gray-400 text-sm">/</span>
                                    <span class="text-gray-500 text-sm"><?php echo e($trip->vehicle->total_seats ?? '?'); ?></span>
                                    <span class="text-xs text-gray-400 ml-1">ghế</span>
                                </div>

                                <span
                                    class="px-5 py-1.5 rounded-2xl text-xs font-semibold
                                    <?php echo e($trip->status === 'completed' ? 'bg-gray-200 text-gray-700' : 'bg-red-100 text-red-700'); ?>">
                                    <?php echo e(match ($trip->status) {
                                        'broken' => 'Hỏng / Gián đoạn',
                                        'completed' => 'Hoàn thành',
                                        'cancelled' => 'Đã hủy',
                                        default => ucfirst($trip->status),
                                    }); ?>

                                </span>
                            </div>

                            <div class="pt-2 border-t">
                                <a href="<?php echo e(route('driver.trips.show', $trip)); ?>"
                                    class="block text-center py-2 text-blue-600 font-medium hover:underline transition">
                                    Xem lại chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            <div class="mt-12 flex justify-center">
                <?php echo e($trips->links()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <script>
        function applyHistoryFilters(status) {
            document.querySelectorAll('.history-status-btn').forEach(btn => {
                if (btn.getAttribute('data-status') === status) {
                    btn.classList.add('bg-amber-500', 'text-white', 'shadow');
                    btn.classList.remove('border', 'border-gray-200');
                } else {
                    btn.classList.remove('bg-amber-500', 'text-white', 'shadow');
                    btn.classList.add('border', 'border-gray-200');
                }
            });

            document.querySelectorAll('.history-card').forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (status === '' || cardStatus === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.driver.DriverLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/driver/trips/history.blade.php ENDPATH**/ ?>