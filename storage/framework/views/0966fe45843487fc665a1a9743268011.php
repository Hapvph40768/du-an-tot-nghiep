<?php $__env->startSection('page-title', 'Chi tiết chuyến xe'); ?>

<?php $__env->startSection('content-main'); ?>
    <div class="max-w-7xl mx-auto px-4 py-10">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
            <div class="flex items-center gap-4">
                <a href="<?php echo e(route('driver.trips.index')); ?>"
                    class="flex items-center gap-2 text-gray-500 hover:text-amber-600 transition-colors">
                    <i class='bx bx-chevron-left text-3xl'></i>
                    <span class="font-medium text-lg">Quay lại</span>
                </a>
            </div>

            <div class="flex items-center gap-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trip->status !== 'completed' && $trip->status !== 'cancelled'): ?>
                <button onclick="showScannerModal()" class="px-5 py-2.5 rounded-3xl text-sm font-semibold bg-blue-600 text-white shadow hover:bg-blue-700 transition flex items-center gap-2">
                    <i class='bx bx-qr-scan text-lg'></i> Quét vé
                </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <span
                    class="px-6 py-2.5 rounded-3xl text-sm font-semibold shadow-sm
                    <?php echo e($trip->status === 'active'
                        ? 'bg-blue-100 text-blue-700'
                        : ($trip->status === 'in_progress' || $trip->status === 'running'
                            ? 'bg-emerald-100 text-emerald-700'
                            : ($trip->status === 'completed'
                                ? 'bg-gray-100 text-gray-700'
                                : 'bg-red-100 text-red-700'))); ?>">
                <?php echo e($trip->status === 'active' ? 'Sắp chạy' : ucfirst($trip->status)); ?>

            </span>
        </div>
        </div> <!-- TĐ: Đây là thẻ đóng của khối flex header -->

        <div class="grid lg:grid-cols-12 gap-8">

            <div class="lg:col-span-8 space-y-8">

                <div class="bg-white rounded-3xl shadow border border-gray-100 overflow-hidden">
                    <div class="h-2 bg-gradient-to-r from-amber-500 to-orange-500"></div>
                    <div class="p-8">
                        <div class="flex justify-between items-start">
                            <div>
                                <span
                                    class="inline-flex items-center gap-3 px-6 py-3 bg-amber-50 text-amber-700 rounded-3xl text-xl font-semibold">
                                    <i class='bx bx-time-five'></i>
                                    <?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('H:i')); ?>

                                </span>
                                <p class="mt-3 text-gray-500 ml-6">
                                    <?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('d/m/Y')); ?>

                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs uppercase tracking-widest text-gray-400">Biển số</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">
                                    <?php echo e($trip->vehicle->license_plate ?? 'Chưa gán'); ?>

                                </p>
                            </div>
                        </div>

                        <div class="mt-12 flex items-center gap-8">
                            <div class="flex-1 text-center">
                                <p class="text-3xl font-bold text-gray-900 leading-tight">
                                    <?php echo e($trip->route->departureLocation->name ?? 'N/A'); ?>

                                </p>
                                <p class="text-sm text-gray-500 mt-2">Điểm khởi hành</p>
                            </div>

                            <div class="flex flex-col items-center text-amber-500">
                                <i class='bx bx-right-arrow-alt text-6xl'></i>
                                <div class="w-24 h-px bg-gradient-to-r from-transparent via-amber-400 to-transparent my-2">
                                </div>
                            </div>

                            <div class="flex-1 text-center">
                                <p class="text-3xl font-bold text-gray-900 leading-tight">
                                    <?php echo e($trip->route->destinationLocation->name ?? 'N/A'); ?>

                                </p>
                                <p class="text-sm text-gray-500 mt-2">Điểm đến</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-14">
                            <div class="bg-gray-50 rounded-2xl p-6">
                                <p class="text-gray-500 text-sm">Khởi hành</p>
                                <p class="text-xl font-semibold mt-2">
                                    <?php echo e(\Carbon\Carbon::parse($trip->trip_date . ' ' . $trip->departure_time)->format('H:i • d/m/Y')); ?>

                                </p>
                            </div>
                            <div class="bg-gray-50 rounded-2xl p-6">
                                <p class="text-gray-500 text-sm">Dự kiến đến nơi</p>
                                <p class="text-xl font-semibold mt-2">
                                    <?php $duration = $trip->route->duration_minutes ?? 300; ?>
                                    <?php echo e(\Carbon\Carbon::parse($trip->trip_date . ' ' . $trip->departure_time)->addMinutes($duration)->format('H:i • d/m/Y')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow border border-gray-100 p-8">
                    <h2 class="flex items-center gap-3 text-xl font-semibold mb-6">
                        <i class='bx bx-bus text-2xl text-amber-500'></i>
                        Thông tin phương tiện
                    </h2>
                    <div class="grid grid-cols-2 gap-x-12 gap-y-8">
                        <div>
                            <p class="text-gray-500">Loại xe</p>
                            <p class="font-semibold text-lg mt-1"><?php echo e($trip->vehicle->type ?? 'Không xác định'); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-500">Tổng số ghế</p>
                            <p class="font-semibold text-lg mt-1"><?php echo e($trip->vehicle->total_seats ?? '?'); ?> ghế</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Biển số xe</p>
                            <p class="font-semibold text-lg mt-1"><?php echo e($trip->vehicle->license_plate ?? 'Chưa gán xe'); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-500">Trạng thái xe</p>
                            <p class="font-semibold text-emerald-600 text-lg mt-1">Sẵn sàng hoạt động</p>
                        </div>
                    </div>
                </div>

                <!-- BEGIN NEW SEAT MAP SECTION -->
                <div class="grid lg:grid-cols-2 gap-8 mb-8">
                    <!-- Seat Map -->
                    <div class="bg-white rounded-3xl shadow border border-gray-100 p-6 sm:p-8">
                        <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                            <i class='bx bx-category text-amber-500'></i> Sơ đồ ghế
                        </h2>
                        
                        <div class="grid grid-cols-4 gap-3 max-w-xs mx-auto relative p-5 bg-gray-50 rounded-3xl border-2 border-gray-200" style="border-top-width: 8px; border-top-color: #cbd5e1;">
                            <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-white px-3 py-1 text-[10px] font-bold text-gray-400 rounded-full border border-gray-200">ĐẦU XE</div>
                            
                            <?php
                                $seatStatus = [];
                                $ticketDataJSON = [];
                                foreach($trip->tickets->where('status', '!=', 'cancelled') as $t) {
                                    $sNum = $t->seat->seat_number ?? $t->seat_number;
                                    $seatStatus[$sNum] = $t;
                                    
                                    $u = $t->booking->user ?? null;
                                    $ticketDataJSON[$sNum] = [
                                        'ticket_id' => $t->id,
                                        'name' => $t->passenger_name ?? ($u->name ?? 'Khách vãng lai'),
                                        'phone' => $u->phone ?? '--',
                                        'code' => $t->ticket_code,
                                        'status' => $t->status,
                                        'payment_status' => $t->booking->status ?? 'pending',
                                        'pickup' => $t->booking->pickupPoint->name ?? 'Tại bến xe'
                                    ];
                                }
                                
                                $vehicleSeats = $trip->vehicle->seats->sortBy('seat_number');
                                if($vehicleSeats->isEmpty() && !empty($trip->vehicle->total_seats)) {
                                    $vehicleSeats = collect();
                                    for($i=1; $i<=$trip->vehicle->total_seats; $i++) {
                                        $vehicleSeats->push((object)['seat_number' => $i]);
                                    }
                                }
                            ?>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vehicleSeats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php
                                    $isBooked = isset($seatStatus[$seat->seat_number]);
                                    $ticket = $isBooked ? $seatStatus[$seat->seat_number] : null;
                                    $isUsed = $isBooked && $ticket->status === 'used';
                                    
                                    $bgClass = $isUsed ? 'bg-emerald-500 text-white border-emerald-600 shadow-sm' :
                                              ($isBooked ? 'bg-amber-400 text-white border-amber-500 shadow-sm' : 'bg-white text-gray-500 border-gray-200 hover:border-amber-300');
                                ?>
                                <div class="aspect-square rounded-xl border-2 flex items-center justify-center font-bold text-base <?php echo e($bgClass); ?> cursor-pointer transition-all hover:scale-105" 
                                     onclick="handleSeatClick('<?php echo e($seat->seat_number); ?>', '<?php echo e($seat->id); ?>', <?php echo e($isBooked ? 'true' : 'false'); ?>)"
                                     id="seat-btn-<?php echo e($seat->seat_number); ?>">
                                    <?php echo e($seat->seat_number); ?>

                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        
                        <div class="mt-8 flex justify-center gap-4 text-xs font-medium text-gray-600">
                            <div class="flex items-center gap-1.5"><div class="w-3.5 h-3.5 rounded bg-white border-2 border-gray-200"></div> Trống</div>
                            <div class="flex items-center gap-1.5"><div class="w-3.5 h-3.5 rounded bg-amber-400 border border-amber-500"></div> Đã đặt</div>
                            <div class="flex items-center gap-1.5"><div class="w-3.5 h-3.5 rounded bg-emerald-500 border border-emerald-600"></div> Kiểm vé</div>
                        </div>
                    </div>
                    
                    <!-- Passenger Details Tab -->
                    <div class="bg-white rounded-3xl shadow border border-gray-100 p-6 sm:p-8 flex flex-col relative" id="passengerDetailArea">
                        <h2 class="text-xl font-semibold mb-6">Thông tin hành khách</h2>
                        
                        <div class="absolute inset-0 z-10 bg-white flex flex-col items-center justify-center rounded-3xl text-gray-400" id="passengerEmptyState">
                            <i class='bx bx-pointer text-5xl mb-3'></i>
                            <p class="text-sm">Bấm vào ghế đã đặt để xem</p>
                        </div>
                        
                        <div id="passengerData" class="hidden flex-col h-full space-y-5">
                            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                                <div>
                                    <p class="text-[11px] text-gray-400 uppercase font-semibold tracking-wider">Họ và tên</p>
                                    <p class="text-lg font-bold text-gray-900 mt-0.5" id="pd-name">--</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[11px] text-gray-400 uppercase font-semibold tracking-wider">Số ghế</p>
                                    <p class="text-2xl font-bold text-amber-600 mt-0.5" id="pd-seat">--</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500">Số điện thoại</p>
                                    <p class="font-medium mt-1" id="pd-phone">--</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Mã vé</p>
                                    <p class="font-mono text-sm font-semibold bg-gray-100 px-2 py-1 rounded inline-block mt-1 uppercase" id="pd-code">--</p>
                                </div>
                            </div>
                            
                            <div class="bg-amber-50/50 rounded-2xl p-4 border border-amber-100">
                                <p class="text-xs text-gray-400 mb-1">Điểm đón khách</p>
                                <p class="font-medium text-gray-900 flex items-start gap-2">
                                    <i class='bx bx-map-pin text-amber-500 mt-0.5'></i>
                                    <span id="pd-pickup">--</span>
                                </p>
                            </div>
                            
                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-100">
                                <div>
                                    <span class="px-3 py-1.5 rounded-xl text-xs font-semibold" id="pd-status-badge">--</span>
                                </div>
                                <div>
                                    <button id="btn-collect-cash" onclick="collectCash()" class="hidden px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-xl text-sm transition-all shadow-sm">
                                        <i class='bx bx-money'></i> Thu tiền
                                    </button>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END NEW SEAT MAP SECTION -->

                <div class="bg-white rounded-3xl shadow border border-gray-100 p-8">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-xl font-semibold">Danh sách hành khách</h2>
                        <div class="text-sm">
                            <span class="font-semibold text-emerald-600">
                                <?php echo e($trip->tickets->where('status', '!=', 'cancelled')->count()); ?>

                            </span>
                            <span class="text-gray-400"> / <?php echo e($trip->vehicle->total_seats ?? '?'); ?> ghế</span>
                        </div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trip->tickets->where('status', '!=', 'cancelled')->isEmpty()): ?>
                        <div class="text-center py-16 text-gray-400">
                            <i class='bx bx-user-x text-6xl mx-auto'></i>
                            <p class="mt-4">Chưa có hành khách nào đặt vé cho chuyến này.</p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-5 font-medium text-gray-500">Họ và tên</th>
                                        <th class="text-left py-5 font-medium text-gray-500">Số ghế</th>
                                        <th class="text-left py-5 font-medium text-gray-500">Số điện thoại</th>
                                        <th class="text-center py-5 font-medium text-gray-500">Mã vé</th>
                                        <th class="text-center py-5 font-medium text-gray-500">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trip->tickets->where('status', '!=', 'cancelled'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <?php
                                            $user = $ticket->booking?->user ?? null;
                                        ?>
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="py-5 font-medium">
                                                <?php echo e($ticket->passenger_name ?? ($user?->name ?? 'Khách vãng lai')); ?>

                                            </td>
                                            <td class="py-5 font-semibold text-amber-600">
                                                <?php echo e($ticket->seat?->seat_number ?? ($ticket->seat_number ?? '—')); ?>

                                            </td>
                                            <td class="py-5 text-gray-600">
                                                <?php echo e($user?->phone ?? '—'); ?>

                                            </td>
                                            <td class="py-5 text-center font-mono text-sm">
                                                <?php echo e($ticket->ticket_code); ?>

                                            </td>
                                            <td class="py-5 text-center">
                                                <span
                                                    class="px-5 py-1.5 text-xs font-medium rounded-3xl
                                                    <?php echo e($ticket->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'); ?>">
                                                    <?php echo e(ucfirst($ticket->status)); ?>

                                                </span>
                                            </td>
                                        </tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">

                <!-- Trạng thái + Hành động -->
                <div class="bg-white rounded-3xl shadow border border-gray-100 p-8 sticky top-8">
                    <h3 class="font-semibold text-lg mb-6">Trạng thái chuyến đi</h3>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trip->status === 'active'): ?>
                        <div
                            class="bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-100 rounded-3xl p-7 text-center mb-8">
                            <p class="text-amber-700 font-medium">Thời gian còn lại</p>
                            <p id="countdown" class="text-5xl font-bold text-amber-600 mt-3 tracking-tighter">—</p>
                            <p class="text-sm text-amber-600 mt-1">trước khi khởi hành</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="space-y-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trip->status === 'active'): ?>
                            <button
                                onclick="if(confirm('Xác nhận bắt đầu chuyến này?')) 
                                window.location.href = '<?php echo e(route('driver.trips.start', $trip)); ?>'"
                                class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-2xl transition-all active:scale-95 flex items-center justify-center gap-2">
                                <i class='bx bx-play-circle text-xl'></i> Bắt đầu chuyến
                            </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <button onclick="showRouteModal()"
                            class="w-full py-4 border border-amber-500 text-amber-600 font-semibold rounded-2xl hover:bg-amber-50 transition flex items-center justify-center gap-2">
                            <i class='bx bx-map-alt text-xl'></i>
                            Xem lộ trình & Điểm đón
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="routeModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white rounded-3xl max-w-xl w-full mx-4 shadow-2xl overflow-hidden">

            <div class="px-8 py-7 border-b flex items-center justify-between bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center">
                        <i class='bx bx-map-alt text-2xl'></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900">Lộ trình chuyến đi</h3>
                        <p class="text-sm text-gray-500">Các điểm dừng đón khách theo thứ tự</p>
                    </div>
                </div>
                <button onclick="closeRouteModal()"
                    class="w-10 h-10 flex items-center justify-center text-3xl text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-2xl transition">
                    ×
                </button>
            </div>

            <div class="p-8 overflow-y-auto" style="max-height: calc(85vh - 180px)">
                <div class="relative pl-12 space-y-12">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $trip->pickupPoints->sortBy('pivot.order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="relative flex gap-6 group">
                            <div class="absolute -left-12 top-3 flex flex-col items-center">
                                <div
                                    class="w-7 h-7 rounded-full bg-amber-500 flex items-center justify-center text-white text-sm font-bold shadow-md">
                                    <?php echo e($index + 1); ?>

                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$loop->last): ?>
                                    <div
                                        class="w-px h-[calc(100%+48px)] bg-gradient-to-b from-amber-300 to-transparent mt-3">
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div
                                class="flex-1 bg-white border border-gray-100 rounded-3xl p-6 hover:border-amber-300 hover:shadow-md transition-all">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="font-semibold text-xl text-gray-900"><?php echo e($point->name); ?></p>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($point->address): ?>
                                            <p class="text-gray-600 mt-2 leading-relaxed"><?php echo e($point->address); ?></p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($point->location): ?>
                                            <p class="text-xs text-gray-400 mt-3 flex items-center gap-1">
                                                <i class='bx bx-map-pin'></i> <?php echo e($point->location->name); ?>

                                            </p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    <button
                                        onclick="openGoogleMaps('<?php echo e(addslashes($point->name)); ?>', '<?php echo e(addslashes($point->address ?? '')); ?>')"
                                        class="flex-shrink-0 flex items-center gap-3 bg-white border-2 border-blue-500 hover:bg-blue-50 hover:border-blue-600 text-blue-600 px-6 py-4 rounded-2xl font-medium transition-all active:scale-95">
                                        <span class="text-xl">
                                            <i class="fa-solid fa-location-arrow"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="text-center py-20">
                            <div class="mx-auto w-20 h-20 bg-gray-100 rounded-3xl flex items-center justify-center">
                                <i class='bx bx-map text-5xl text-gray-300'></i>
                            </div>
                            <p class="mt-6 text-gray-400 text-lg">Chuyến này chưa có điểm đón nào được thiết lập.</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="px-8 py-6 border-t bg-gray-50 flex justify-end rounded-b-3xl">
                <button onclick="closeRouteModal()"
                    class="px-10 py-3.5 bg-white border border-gray-300 hover:border-gray-400 font-medium rounded-2xl transition text-gray-700">
                    Đóng
                </button>
            </div>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trip->status === 'active'): ?>
        <script>
            function startCountdown() {
                const departure = new Date(
                    "<?php echo e(\Carbon\Carbon::parse($trip->trip_date . ' ' . $trip->departure_time)->format('Y-m-d H:i:s')); ?>");
                const el = document.getElementById('countdown');

                const interval = setInterval(() => {
                    const diff = departure - new Date();
                    if (diff <= 0) {
                        el.textContent = "Đã đến giờ";
                        clearInterval(interval);
                        return;
                    }
                    const hours = Math.floor(diff / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    el.textContent = `${hours}h ${minutes}m`;
                }, 1000);
            }
            document.addEventListener('DOMContentLoaded', startCountdown);
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Scanner Modal -->
    <div id="scannerModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-[60] p-4">
        <div class="bg-white rounded-3xl max-w-md w-full shadow-2xl overflow-hidden relative">
            <div class="px-6 py-5 border-b flex items-center justify-between bg-gradient-to-r from-blue-50 to-white">
                <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                    <i class='bx bx-qr-scan text-blue-600'></i> Web Scanner
                </h3>
                <button onclick="closeScannerModal()" class="w-8 h-8 flex items-center justify-center text-2xl text-gray-400 hover:text-gray-600 rounded-xl transition">×</button>
            </div>
            
            <div class="p-6">
                <!-- Wrapper cho html5-qrcode -->
                <div id="reader" width="600px" class="bg-black rounded-xl overflow-hidden mb-6 shadow-inner aspect-square"></div>
                
                <div class="text-center bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <p class="text-sm text-gray-500 mb-3 font-medium">Hoặc nhập mã vé thủ công</p>
                    <div class="flex gap-2">
                        <input type="text" id="manualTicketCode" class="flex-1 border border-gray-300 rounded-xl px-4 py-2 text-center uppercase font-mono tracking-wider focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="VD: VE-2023-XXXXX">
                        <button onclick="checkinManual()" id="btnCheckinManual" class="px-5 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 font-medium transition whitespace-nowrap active:scale-95 shadow-sm">Tìm</button>
                    </div>
                </div>
                
                <div id="checkinResult" class="mt-4 hidden p-4 rounded-xl text-sm font-medium text-center border"></div>
            </div>
        </div>
    </div>
    <!-- Walk-in Modal -->
    <div id="walkinModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-[70] p-4">
        <div class="bg-white rounded-3xl max-w-sm w-full shadow-2xl overflow-hidden relative">
            <div class="px-6 py-5 border-b bg-gradient-to-r from-amber-50 to-white flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                    <i class='bx bx-user-plus text-amber-500'></i> Khách lẻ dọc đường
                </h3>
                <button onclick="closeWalkinModal()" class="text-2xl text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <div class="p-6">
                <p class="text-sm text-gray-500 mb-4">Ghế muốn đặt: <span id="walkin-seat-badge" class="font-bold text-amber-600 text-lg ml-1"></span></p>
                <input type="hidden" id="walkin-seat-id" value="">
                <input type="hidden" id="walkin-seat-number" value="">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tên khách hàng *</label>
                        <input type="text" id="walkin-name" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-amber-500 focus:border-amber-500 outline-none" placeholder="Nhập tên khách">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                        <input type="text" id="walkin-phone" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-amber-500 focus:border-amber-500 outline-none" placeholder="Nếu có">
                    </div>
                    <div class="bg-blue-50 text-blue-800 text-sm p-3 rounded-xl border border-blue-100 flex gap-2">
                        <i class='bx bx-info-circle text-lg mt-0.5'></i>
                        <p>Thao tác này đồng thời cập nhật "Đã thu tiền mặt" cho khách lên xe.</p>
                    </div>
                    <div id="walkinResult" class="hidden w-full text-center text-sm font-medium p-2 rounded-xl"></div>
                    <button onclick="submitWalkin()" id="btn-submit-walkin" class="w-full py-3 bg-amber-500 text-white font-bold rounded-xl hover:bg-amber-600 transition shadow-sm mt-2 flex justify-center items-center gap-2">
                        <i class='bx bx-check-circle text-lg'></i> Tạo vé & Thu tiền
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- html5-qrcode library -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        const ticketDataMap = <?php echo json_encode($ticketDataJSON ?? []); ?>;
        let currentSelectedTicketId = null;

        function handleSeatClick(seatNumber, seatId, isBooked) {
            if(isBooked) {
                showPassengerDetail(seatNumber);
            } else {
                openWalkinModal(seatNumber, seatId);
            }
        }

        function showPassengerDetail(seatNumber) {
            const data = ticketDataMap[seatNumber];
            if(!data) return;
            
            currentSelectedTicketId = data.ticket_id;

            document.getElementById('passengerEmptyState').classList.add('hidden');
            document.getElementById('passengerData').classList.remove('hidden');
            document.getElementById('passengerData').classList.add('flex');
            
            document.getElementById('pd-name').textContent = data.name;
            document.getElementById('pd-seat').textContent = seatNumber;
            document.getElementById('pd-phone').textContent = data.phone;
            document.getElementById('pd-code').textContent = data.code;
            document.getElementById('pd-pickup').textContent = data.pickup;
            
            const badge = document.getElementById('pd-status-badge');
            if(data.status === 'used') {
                badge.className = "px-3 py-1.5 rounded-xl text-xs font-semibold bg-emerald-100 text-emerald-700";
                badge.textContent = "Đã check-in";
            } else if(data.status === 'confirmed') {
                badge.className = "px-3 py-1.5 rounded-xl text-xs font-semibold bg-blue-100 text-blue-700";
                badge.textContent = "Đã lên xe";
            } else {
                badge.className = "px-3 py-1.5 rounded-xl text-xs font-semibold bg-gray-100 text-gray-700";
                badge.textContent = data.status.toUpperCase();
            }

            // Thu tiền mặt button
            const btnCollect = document.getElementById('btn-collect-cash');
            if(data.payment_status !== 'paid') {
                btnCollect.classList.remove('hidden');
            } else {
                btnCollect.classList.add('hidden');
            }
        }

        function collectCash() {
            if(!currentSelectedTicketId) return;
            if(!confirm('Xác nhận đã thu tiền mặt trực tiếp từ khách hàng này?')) return;
            
            const btnCollect = document.getElementById('btn-collect-cash');
            btnCollect.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Đang xử lý";
            btnCollect.disabled = true;

            fetch(`/driver/tickets/${currentSelectedTicketId}/pay`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    showToast(data.message);
                    btnCollect.classList.add('hidden');
                    // Cập nhật state nội bộ
                    Object.keys(ticketDataMap).forEach(key => {
                        if(ticketDataMap[key].ticket_id === currentSelectedTicketId) {
                            ticketDataMap[key].payment_status = 'paid';
                        }
                    });
                } else {
                    alert(data.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert("Lỗi kết nối khi thu tiền!");
            })
            .finally(() => {
                btnCollect.innerHTML = "<i class='bx bx-money'></i> Thu tiền";
                btnCollect.disabled = false;
            });
        }

        function openWalkinModal(seatNumber, seatId) {
            document.getElementById('walkinModal').classList.remove('hidden');
            document.getElementById('walkin-seat-badge').textContent = seatNumber;
            document.getElementById('walkin-seat-id').value = seatId;
            document.getElementById('walkin-seat-number').value = seatNumber;
            
            document.getElementById('walkin-name').value = '';
            document.getElementById('walkin-phone').value = '';
            document.getElementById('walkinResult').classList.add('hidden');
        }

        function closeWalkinModal() {
            document.getElementById('walkinModal').classList.add('hidden');
        }

        function submitWalkin() {
            const name = document.getElementById('walkin-name').value.trim();
            const phone = document.getElementById('walkin-phone').value.trim();
            const seatId = document.getElementById('walkin-seat-id').value;
            const seatNumber = document.getElementById('walkin-seat-number').value;

            if(!name) {
                alert('Vui lòng nhập tên hành khách');
                return;
            }

            const btnSubmit = document.getElementById('btn-submit-walkin');
            const resultBox = document.getElementById('walkinResult');

            btnSubmit.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Đang xử lý...";
            btnSubmit.disabled = true;
            resultBox.classList.add('hidden');

            fetch(`/driver/trips/<?php echo e($trip->id); ?>/walk-in`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({
                    seat_id: seatId,
                    passenger_name: name,
                    contact_phone: phone
                })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    resultBox.classList.remove('hidden', 'bg-red-50', 'text-red-600');
                    resultBox.classList.add('bg-emerald-50', 'text-emerald-700');
                    resultBox.innerHTML = `<i class='bx bx-check-circle'></i> ${data.message}`;
                    
                    // Thêm data vào Map
                    ticketDataMap[seatNumber] = Object.assign({}, data.ticket, {
                        ticket_id: data.ticket.id,
                        payment_status: 'paid'
                    });

                    // Đổi giao diện nút ghế
                    const seatBtn = document.getElementById('seat-btn-' + seatNumber);
                    if(seatBtn) {
                        seatBtn.className = "aspect-square rounded-xl border-2 flex items-center justify-center font-bold text-base bg-emerald-500 text-white border-emerald-600 shadow-sm cursor-pointer transition-all hover:scale-105";
                        seatBtn.setAttribute('onclick', `handleSeatClick('${seatNumber}', '${seatId}', true)`);
                    }

                    setTimeout(() => {
                        closeWalkinModal();
                        showPassengerDetail(seatNumber);
                    }, 1500);

                } else {
                    resultBox.classList.remove('hidden', 'bg-emerald-50', 'text-emerald-700');
                    resultBox.classList.add('bg-red-50', 'text-red-700');
                    resultBox.textContent = data.message;
                }
            })
            .catch(err => {
                console.error(err);
                resultBox.classList.remove('hidden', 'bg-emerald-50');
                resultBox.classList.add('bg-red-50', 'text-red-700');
                resultBox.textContent = 'Lỗi mạng khi tạo vé';
            })
            .finally(() => {
                btnSubmit.innerHTML = "<i class='bx bx-check-circle text-lg'></i> Tạo vé & Thu tiền";
                btnSubmit.disabled = false;
            });
        }

        let html5QrcodeScanner = null;

        function showScannerModal() {
            document.getElementById('scannerModal').classList.remove('hidden');
            document.getElementById('checkinResult').classList.add('hidden');
            document.getElementById('manualTicketCode').value = '';
            
            if (!html5QrcodeScanner) {
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader",
                    { fps: 10, qrbox: {width: 250, height: 250} },
                    /* verbose= */ false);
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            }
        }

        function closeScannerModal() {
            document.getElementById('scannerModal').classList.add('hidden');
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear().catch(error => {
                    console.error("Failed to clear html5QrcodeScanner. ", error);
                });
                html5QrcodeScanner = null;
            }
        }

        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Scan result: ${decodedText}`);
            // temporary stop scanning
            if(html5QrcodeScanner) html5QrcodeScanner.pause();
            processCheckin(decodedText);
        }

        function onScanFailure(error) {
            // handle error if needed
        }

        function checkinManual() {
            const code = document.getElementById('manualTicketCode').value.trim().toUpperCase();
            if(!code) return;
            document.getElementById('btnCheckinManual').innerHTML = "<i class='bx bx-loader-alt bx-spin'></i>";
            processCheckin(code);
        }

        function processCheckin(ticketCode) {
            const resultBox = document.getElementById('checkinResult');
            resultBox.classList.remove('hidden', 'bg-emerald-50', 'text-emerald-700', 'border-emerald-200', 'bg-red-50', 'text-red-700', 'border-red-200');
            resultBox.textContent = "Đang xử lý...";
            resultBox.classList.add('bg-blue-50', 'text-blue-700', 'border-blue-200');

            fetch(`<?php echo e(route('driver.trips.checkin', $trip->id)); ?>`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' // make sure meta csrf is present or layout injects it
                },
                body: JSON.stringify({ ticket_code: ticketCode })
            })
            .then(res => res.json())
            .then(data => {
                resultBox.classList.remove('bg-blue-50', 'text-blue-700', 'border-blue-200');
                if (data.success) {
                    resultBox.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-200');
                    resultBox.innerHTML = `<i class='bx bx-check-circle text-lg align-middle mr-1'></i> ${data.message}`;
                    
                    // Update seat map UI dynamically
                    if(data.seat_number && ticketDataMap[data.seat_number]) {
                        ticketDataMap[data.seat_number].status = 'used';
                        const seatBtn = document.getElementById('seat-btn-' + data.seat_number);
                        if(seatBtn) {
                            seatBtn.className = "aspect-square rounded-xl border-2 flex items-center justify-center font-bold text-base bg-emerald-500 text-white border-emerald-600 shadow-sm cursor-pointer transition-all hover:scale-105";
                        }
                        
                        // if that seat is currently selected in panel, update badge
                        if(document.getElementById('pd-seat').textContent == data.seat_number) {
                            showPassengerDetail(data.seat_number);
                        }
                    }
                    setTimeout(() => {
                        if(html5QrcodeScanner) html5QrcodeScanner.resume();
                        document.getElementById('manualTicketCode').value = '';
                        resultBox.classList.add('hidden');
                    }, 3000);
                } else {
                    resultBox.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
                    resultBox.innerHTML = `<i class='bx bx-error text-lg align-middle mr-1'></i> ${data.message}`;
                    setTimeout(() => {
                        if(html5QrcodeScanner) html5QrcodeScanner.resume();
                    }, 3000);
                }
            })
            .catch(err => {
                console.error(err);
                resultBox.classList.remove('bg-blue-50', 'text-blue-700', 'border-blue-200');
                resultBox.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
                resultBox.textContent = "Lỗi kết nối mạng, vui lòng thử lại!";
                setTimeout(() => { if(html5QrcodeScanner) html5QrcodeScanner.resume(); }, 2000);
            })
            .finally(() => {
                document.getElementById('btnCheckinManual').innerHTML = "Tìm";
            });
        }

        function showRouteModal() {
            const modal = document.getElementById('routeModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeRouteModal() {
            const modal = document.getElementById('routeModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openGoogleMaps(name, address) {
            let query = address ? address : name;
            const encodedQuery = encodeURIComponent(query.trim());

            const googleMapsUrl = `https://www.google.com/maps/search/?api=1&query=${encodedQuery}`;

            window.open(googleMapsUrl, '_blank');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") closeRouteModal();
        });

        document.getElementById('routeModal').addEventListener('click', function(e) {
            if (e.target === this) closeRouteModal();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.driver.DriverLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/driver/trips/show.blade.php ENDPATH**/ ?>