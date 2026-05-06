<?php $__env->startSection('content-main'); ?>
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Đổi Chuyến / Ngày đi (Mã vé: #<?php echo e($booking->id); ?>)</h2>
                <a href="<?php echo e(route('customer.bookings.show', $booking->id)); ?>" class="text-indigo-600 font-medium hover:underline">
                    &larr; Quay lại
                </a>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                    <?php echo e(session('error')); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="font-bold text-lg mb-4 text-gray-800 border-b pb-2">Thông tin đổi vé</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Tiền vé cũ đã thanh toán:</p>
                        <p class="font-bold text-gray-800"><?php echo e(number_format($booking->total_amount)); ?> đ</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-red-500">Phí đổi vé (10%):</p>
                        <p class="font-bold text-red-600">-<?php echo e(number_format($penaltyFee)); ?> đ</p>
                    </div>
                    <div class="col-span-2 pt-2 border-t">
                        <p class="text-gray-500">Giá trị vé cũ được bảo lưu (để trừ vào vé mới):</p>
                        <p class="font-bold text-green-600 text-xl"><?php echo e(number_format($creditAmount)); ?> đ</p>
                    </div>
                </div>
            </div>

            <form action="<?php echo e(route('customer.bookings.processChangeDate', $booking->id)); ?>" method="POST" id="changeDateForm">
                <?php echo csrf_field(); ?>
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-800 border-b pb-2">Chọn chuyến xe mới</h3>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($availableTrips->isEmpty()): ?>
                        <div class="text-center py-6 text-gray-500">Không có chuyến xe nào khả dụng trên tuyến này trong tương lai.</div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $availableTrips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <label class="block border rounded-lg p-4 cursor-pointer hover:bg-indigo-50 transition-colors">
                                    <div class="flex items-start">
                                        <input type="radio" name="new_trip_id" value="<?php echo e($trip->id); ?>" class="mt-1 trip-radio" required data-price="<?php echo e($trip->price); ?>" data-trip-id="<?php echo e($trip->id); ?>">
                                        <div class="ml-3 flex-1">
                                            <p class="font-bold text-gray-800">Khởi hành: <?php echo e(\Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y')); ?> lúc <?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('H:i')); ?></p>
                                            <p class="text-sm text-gray-600">Nhà xe: <?php echo e($trip->vehicle->license_plate ?? 'Chưa xác định'); ?> - Giá: <span class="text-amber-600 font-bold"><?php echo e(number_format($trip->price)); ?>đ/ghế</span></p>
                                            
                                            <!-- Hiển thị ghế trực tiếp trong form -->
                                            <div class="mt-3 hidden seats-container" id="seats-<?php echo e($trip->id); ?>">
                                                <p class="text-sm font-medium mb-2">Chọn ghế (Số lượng ghế yêu cầu: <?php echo e($booking->tickets->count()); ?>):</p>
                                                <div class="flex flex-wrap gap-2">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trip->vehicle->seats ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                                        <?php
                                                            $isLocked = \App\Models\SeatLock::where('trip_id', $trip->id)
                                                                ->where('seat_id', $seat->id)
                                                                ->where('locked_until', '>', now())
                                                                ->exists() || \App\Models\Ticket::where('trip_id', $trip->id)->where('seat_id', $seat->id)->where('status', '!=', 'cancelled')->exists();
                                                        ?>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLocked): ?>
                                                            <div class="px-3 py-1 bg-gray-200 text-gray-400 rounded cursor-not-allowed text-sm line-through">
                                                                <?php echo e($seat->seat_number); ?>

                                                            </div>
                                                        <?php else: ?>
                                                            <label class="px-3 py-1 bg-white border border-indigo-300 text-indigo-700 rounded cursor-pointer hover:bg-indigo-100 text-sm has-[:checked]:bg-indigo-600 has-[:checked]:text-white">
                                                                <input type="checkbox" name="seat_ids[]" value="<?php echo e($seat->id); ?>" class="hidden seat-checkbox" disabled>
                                                                <?php echo e($seat->seat_number); ?>

                                                            </label>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="text-center pt-4 sticky bottom-4">
                    <button type="submit" class="w-full md:w-auto bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-colors text-lg" onclick="return confirm('Bạn có chắc chắn xác nhận đổi sang vé mới? Nếu phải thanh toán bù, bạn sẽ được chuyển đến trang thanh toán.')">
                        <i class="fas fa-check-circle mr-2"></i> Xác nhận Đổi Vé
                    </button>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tripRadios = document.querySelectorAll('.trip-radio');
            
            tripRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Ẩn tất cả bảng ghế
                    document.querySelectorAll('.seats-container').forEach(el => {
                        el.classList.add('hidden');
                        // Disable tất cả checkbox ghế để ko gửi lung tung
                        el.querySelectorAll('.seat-checkbox').forEach(cb => cb.disabled = true);
                    });

                    // Hiển thị bảng chọn ghế của chuyến được chọn
                    if(this.checked) {
                        const targetId = 'seats-' + this.dataset.tripId;
                        const container = document.getElementById(targetId);
                        if(container) {
                            container.classList.remove('hidden');
                            container.querySelectorAll('.seat-checkbox').forEach(cb => cb.disabled = false);
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\customer\bookings\change-date.blade.php ENDPATH**/ ?>