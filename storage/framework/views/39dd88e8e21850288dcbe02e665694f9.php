<?php $__env->startSection('content-main'); ?>
    <section class="py-12 bg-gray-50 border-t">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6">Chi tiết chuyến xe và Chọn chỗ</h2>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form action="<?php echo e(route('customer.bookings.store')); ?>" method="POST" id="booking-form">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="trip_id" value="<?php echo e($trip->id); ?>">
                
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Left: Trip info & Contact -->
                    <div class="md:col-span-2 space-y-6">
                        
                        <!-- 1. Trip Summary -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-xl font-bold border-b pb-3 mb-4">Thông tin chuyến</h3>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Tuyến đường</span>
                                <span class="text-gray-900"><?php echo e($trip->route->departureLocation->name ?? '...'); ?> → <?php echo e($trip->route->destinationLocation->name ?? '...'); ?></span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Khởi hành</span>
                                <span class="text-gray-900"><?php echo e(\Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y')); ?> - <?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('H:i')); ?></span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Dự kiến đến</span>
                                <span class="text-gray-900"><?php echo e(\Carbon\Carbon::parse($trip->arrival_time)->format('H:i')); ?></span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Giá vé</span>
                                <span class="text-amber-600 font-bold" id="ticket-price" data-price="<?php echo e($trip->price); ?>"><?php echo e(number_format($trip->price, 0, ',', '.')); ?> đ</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Tên tài xế</span>
                                <span class="text-gray-900"><?php echo e($trip->driver->name ?? 'Đang cập nhật'); ?></span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">Loại xe</span>
                                <span class="text-gray-900"><?php echo e($trip->vehicle->type ?? 'Seat/Bed'); ?> (<?php echo e($trip->vehicle->license_plate ?? 'CX-00000'); ?>)</span>
                            </div>
                            <div class="flex justify-between items-center mb-4 border-t pt-2 mt-2 border-dashed">
                                <span class="font-semibold text-gray-700">SĐT Nhà xe (Hỗ trợ)</span>
                                <span class="text-amber-600 font-bold text-lg">
                                    <i class="fas fa-phone-alt text-sm mr-1"></i> <?php echo e($trip->vehicle->phone_vehicles ?? 'Đang cập nhật'); ?>

                                </span>
                            </div>
                            
                            <hr class="mb-4">
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Chọn ngày đi <span class="text-red-500">*</span></label>
                                <input type="date" name="selected_departure_date" value="<?php echo e($trip->trip_date); ?>" class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-500">
                            </div>
                            
                            <div class="mb-2">
                                <label class="block text-gray-700 font-medium mb-2">Điểm lên xe <span class="text-red-500">*</span></label>
                                <select name="pickup_point_id" id="pickup_point_select" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-amber-500 transition-colors">
                                    <option value="" data-address="<?php echo e($trip->route->departureLocation->name ?? 'Bến xe'); ?>">-- Chọn điểm đón --</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trip->pickupPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($point->id); ?>" data-address="<?php echo e($point->address ? $point->address . ', ' . $point->name : $point->name); ?>" <?php echo e(old('pickup_point_id') == $point->id ? 'selected' : ''); ?>>
                                            <?php echo e(\Carbon\Carbon::parse($point->pivot->pickup_time ?? $trip->departure_time)->format('H:i')); ?> - <?php echo e($point->name); ?> (<?php echo e($point->address); ?>)
                                        </option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>

                            <!-- Bản đồ bến xe / điểm đón -->
                            <div class="mt-4 rounded-lg overflow-hidden border border-gray-200 shadow-sm relative h-56 bg-gray-100">
                                <div id="map-loading" class="absolute inset-0 flex items-center justify-center bg-gray-50 z-0">
                                    <span class="text-gray-500 text-sm flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> 
                                        Đang tải bản đồ bến xe...
                                    </span>
                                </div>
                                <iframe id="station-map" class="absolute inset-0 w-full h-full z-10 opacity-0 transition-opacity duration-500" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>

                        <!-- 2. Pickup & Contact Info -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-xl font-bold border-b pb-3 mb-4">Thông tin hành khách</h3>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Họ tên người đi <span class="text-red-500">*</span></label>
                                <input type="text" name="contact_name" required value="<?php echo e(old('contact_name', Auth::user()->name ?? '')); ?>"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-amber-500">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Số điện thoại <span class="text-red-500">*</span></label>
                                <input type="text" name="contact_phone" required value="<?php echo e(old('contact_phone', Auth::user()->phone ?? '')); ?>"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-amber-500">
                            </div>

                            <div class="mb-2">
                                <!-- Điểm đón đã được dịch chuyển -->
                            </div>
                            <!-- Lưu ý: Nếu user chưa đăng nhập, web sẽ chặn khi submit do có auth middleware, đây là flow chuẩn -->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                                <p class="text-sm text-amber-600 mt-2"><i>Lưu ý: Bạn sẽ được yêu cầu Đăng nhập hệ thống trước lưu đơn.</i></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <!-- Right: Seat selection & Summary -->
                    <div class="bg-white rounded-xl shadow-sm p-6 self-start sticky top-6">
                        <h3 class="text-xl font-bold border-b pb-3 mb-4">Chọn ghế</h3>
                        
                        <div class="flex justify-between mb-4 text-sm max-w-[200px] mx-auto">
                            <div class="flex items-center gap-1"><div class="w-4 h-4 bg-gray-200 border rounded"></div> Trống</div>
                            <div class="flex items-center gap-1"><div class="w-4 h-4 bg-amber-500 rounded"></div> Đang chọn</div>
                            <div class="flex items-center gap-1"><div class="w-4 h-4 bg-red-800 rounded"></div> Đã đặt</div>
                        </div>

                        <!-- Sơ đồ ghế đơn giản -->
                        <div class="grid grid-cols-4 gap-2 mb-6">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trip->vehicle->seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php
                                    $isBooked = in_array($seat->id, $bookedSeatIds);
                                ?>
                                <label class="relative cursor-pointer">
                                    <input type="checkbox" name="seat_ids[]" value="<?php echo e($seat->id); ?>" class="peer sr-only seat-checkbox" 
                                        <?php echo e($isBooked ? 'disabled' : ''); ?>>
                                    
                                    <div class="w-full aspect-square flex items-center justify-center rounded border font-medium text-sm
                                        <?php echo e($isBooked ? 'bg-red-800 text-white border-red-900 cursor-not-allowed' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 peer-checked:bg-amber-500 peer-checked:text-white peer-checked:border-amber-600 transition-colors'); ?>">
                                        <?php echo e($seat->seat_number); ?>

                                    </div>
                                </label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>

                        <div class="border-t pt-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Ghế đã chọn:</span>
                                <span id="selected-seats-display" class="font-medium text-right text-sm">Chưa có</span>
                            </div>
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-gray-600 font-medium">Tổng tiền:</span>
                                <span id="total-price-display" class="text-xl font-bold text-amber-600">0 đ</span>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                                <a href="<?php echo e(route('login')); ?>" class="block text-center w-full py-3 rounded-lg font-bold text-white bg-amber-500 hover:bg-amber-600 transition-colors">
                                    Đăng nhập để đặt vé
                                </a>
                            <?php else: ?>
                                <button type="submit" id="submit-btn" disabled class="w-full py-3 rounded-lg font-bold text-white bg-gray-400 cursor-not-allowed transition-colors">
                                    Tiếp tục
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- JS Logic cho chọn ghế -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.seat-checkbox:not(:disabled)');
            const selectedDisplay = document.getElementById('selected-seats-display');
            const totalDisplay = document.getElementById('total-price-display');
            const submitBtn = document.getElementById('submit-btn');
            
            const pricePerSeat = parseInt(document.getElementById('ticket-price').getAttribute('data-price')) || 0;

            function updateSummary() {
                let selectedNames = [];
                let count = 0;
                
                checkboxes.forEach(cb => {
                    if(cb.checked) {
                        count++;
                        // Extract seat name from sibling div text
                        selectedNames.push(cb.nextElementSibling.innerText.trim());
                    }
                });

                if(count > 0) {
                    selectedDisplay.innerText = selectedNames.join(', ');
                    totalDisplay.innerText = new Intl.NumberFormat('vi-VN').format(count * pricePerSeat) + ' đ';
                    
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                        submitBtn.classList.add('bg-amber-500', 'hover:bg-amber-600');
                    }
                } else {
                    selectedDisplay.innerText = 'Chưa có';
                    totalDisplay.innerText = '0 đ';
                    
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                        submitBtn.classList.remove('bg-amber-500', 'hover:bg-amber-600');
                    }
                }
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', updateSummary);
            });

            // Logic cho bản đồ điểm đón
            const pickupSelect = document.getElementById('pickup_point_select');
            const stationMap = document.getElementById('station-map');
            
            function updateMap() {
                if(!pickupSelect || !stationMap) return;
                const selectedOption = pickupSelect.options[pickupSelect.selectedIndex];
                const address = selectedOption.getAttribute('data-address');
                
                if(address) {
                    // Mờ đi trước khi đổi để tạo hiệu ứng
                    stationMap.classList.remove('opacity-100');
                    stationMap.classList.add('opacity-0');
                    
                    setTimeout(() => {
                        stationMap.src = `https://www.google.com/maps?q=${encodeURIComponent(address)}&output=embed`;
                        stationMap.onload = () => {
                            stationMap.classList.remove('opacity-0');
                            stationMap.classList.add('opacity-100');
                        };
                    }, 300);
                }
            }

            if(pickupSelect) {
                pickupSelect.addEventListener('change', updateMap);
                updateMap(); // Load bản đồ lần đầu khi vào trang
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/customer/trips/show.blade.php ENDPATH**/ ?>