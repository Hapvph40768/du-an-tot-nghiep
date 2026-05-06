<?php $__env->startSection('content-main'); ?>
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Chi tiết đơn đặt vé #<?php echo e($booking->id); ?></h2>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                    <?php echo e(session('success')); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="font-bold text-lg border-b pb-3 mb-4 text-gray-800">Thông tin chuyến đi</h3>
                    <div class="space-y-3 text-sm">
                        <p class="flex justify-between"><span class="text-gray-500">Tuyến:</span> <span
                                class="font-bold text-gray-800 text-right"><?php echo e($booking->trip->route->departureLocation->name ?? '...'); ?>

                                → <?php echo e($booking->trip->route->destinationLocation->name ?? '...'); ?></span></p>
                        <p class="flex justify-between"><span class="text-gray-500">Khởi hành:</span> <span
                                class="font-medium text-gray-800"><?php echo e(\Carbon\Carbon::parse($booking->trip->datex)->format('d/m/Y')); ?>

                                lúc <?php echo e(\Carbon\Carbon::parse($booking->trip->departure_time)->format('H:i')); ?></span></p>
                        <p class="flex justify-between"><span class="text-gray-500">Số điện thoại xe:</span> <span
                                class="font-medium text-gray-800"><a
                                    href="tel:<?php echo e($booking->trip->vehicle->phone_vehicles ?? ''); ?>"
                                    class="text-indigo-700"><?php echo e($booking->trip->vehicle->phone_vehicles ?? 'Chưa có'); ?></a></span>
                        </p>
                        <p class="flex justify-between border-t pt-3"><span class="text-gray-500">Điểm đón:</span> <span
                                class="font-medium text-indigo-700 text-right"><?php echo e($booking->pickupPoint->name ?? 'Không có thông tin'); ?>

                                <br><span
                                    class="text-xs text-gray-500">(<?php echo e($booking->pickupPoint->address ?? ''); ?>)</span></span>
                        </p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->dropoffPoint): ?>
                        <p class="flex justify-between pt-2"><span class="text-gray-500">Điểm trả khách:</span> <span
                                class="font-medium text-rose-600 text-right"><?php echo e($booking->dropoffPoint->name); ?>

                                <br><span
                                    class="text-xs text-gray-500">(<?php echo e($booking->dropoffPoint->address ?? ''); ?>)</span></span>
                        </p>
                        <?php else: ?>
                        <p class="flex justify-between pt-2"><span class="text-gray-500">Điểm trả khách:</span>
                            <span class="text-gray-400 italic text-sm">Điểm cuối tuyến</span>
                        </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="font-bold text-lg border-b pb-3 mb-4 text-gray-800">Thông tin khách hàng & Thanh toán</h3>
                    <div class="space-y-3 text-sm">
                        <p class="flex justify-between"><span class="text-gray-500">Người đặt:</span> <span
                                class="font-medium text-gray-800"><?php echo e($booking->contact_name); ?></span></p>
                        <p class="flex justify-between"><span class="text-gray-500">Điện thoại:</span> <span
                                class="font-medium text-gray-800"><?php echo e($booking->contact_phone); ?></span></p>
                        <p class="flex justify-between items-center"><span class="text-gray-500">Trạng thái:</span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status == 'pending'): ?>
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-bold">Chờ thanh
                                    toán</span>
                            <?php elseif($booking->status == 'paid'): ?>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">Đã thanh
                                    toán</span>
                            <?php else: ?>
                                <span
                                    class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs font-bold"><?php echo e($booking->status); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
                        <p class="flex justify-between items-center border-t pt-3">
                            <span class="text-gray-500">Tổng tiền:</span>
                            <span
                                class="font-bold text-amber-600 text-xl"><?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?>

                                đ</span>
                        </p>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status == 'pending'): ?>
                            <div class="mt-4">
                                <a href="<?php echo e(route('customer.payment.checkout', $booking->id)); ?>"
                                    class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition-all duration-200">
                                    <i class="fas fa-credit-card mr-2"></i> Thanh toán đơn hàng này
                                </a>
                            </div>
                        <?php elseif($booking->status == 'paid'): ?>
                            <div class="mt-4 flex gap-2">
                                <a href="<?php echo e(route('customer.bookings.changeDate', $booking->id)); ?>" class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200">
                                    <i class="fas fa-exchange-alt mr-1"></i> Đổi chuyến
                                </a>
                                <form action="<?php echo e(route('customer.bookings.cancel', $booking->id)); ?>" method="POST" class="flex-1" onsubmit="return confirm('Bạn có chắc chắn muốn hủy vé?\nNếu hủy sau 30 phút từ khi đặt sẽ chịu phí 10%. Tiền sẽ được hoàn lại sau khi trừ phí.');">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-center bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200">
                                        <i class="fas fa-times mr-1"></i> Hủy vé
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 mt-6 border border-gray-100">
                <h3 class="font-bold text-lg border-b pb-3 mb-4 text-gray-800">Danh sách vé</h3>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->tickets->isEmpty()): ?>
                    <div class="text-center py-6 bg-gray-50 rounded-lg">
                        <p class="text-gray-500 mb-4">Chưa có vé điện tử được xuất (Đơn hàng đang chờ thanh toán).</p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status == 'pending'): ?>
                            <a href="<?php echo e(route('customer.payment.checkout', $booking->id)); ?>"
                                class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-lg font-bold shadow-sm transition-colors inline-block">
                                Thanh toán ngay để nhận vé
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $booking->tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <div
                                class="border rounded-xl p-4 bg-gradient-to-br from-indigo-50 to-blue-50 relative overflow-hidden shadow-sm">
                                <div
                                    class="absolute top-0 right-0 bg-green-500 text-white text-[10px] uppercase tracking-wider px-2 py-1 rounded-bl-lg font-bold">
                                    Xác nhận</div>
                                <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Mã vé điện tử</p>
                                <p class="font-mono font-bold text-lg text-gray-800 mb-2"><?php echo e($ticket->ticket_code); ?></p>
                                <div class="flex items-end justify-between border-t border-indigo-100 pt-2 mt-2">
                                    <span class="text-xs text-gray-600">Ghế ngồi</span>
                                    <span class="font-bold text-2xl text-amber-600"><?php echo e($ticket->seat->seat_number); ?></span>
                                </div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="rounded-xl p-5 mt-6 flex gap-4 items-start shadow-sm border
                <?php echo e($booking->status == 'paid' ? 'bg-amber-50 border-amber-300' : 'bg-blue-50 border-blue-300'); ?>">
                <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center
                    <?php echo e($booking->status == 'paid' ? 'bg-amber-400' : 'bg-blue-400'); ?>">
                    <i class="fas fa-info text-white text-lg"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-base mb-2
                        <?php echo e($booking->status == 'paid' ? 'text-amber-800' : 'text-blue-800'); ?>">
                        📋 Lưu ý check-in tại quầy
                    </h4>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status == 'pending'): ?>
                    <div class="text-sm text-blue-700 bg-blue-100 border border-blue-200 rounded-lg px-4 py-2 mb-3">
                        ⏳ Đơn hàng <strong>chưa thanh toán</strong>. Vui lòng hoàn tất thanh toán để nhận mã vé và ghế chính thức.
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <ul class="text-sm space-y-1.5 list-none
                        <?php echo e($booking->status == 'paid' ? 'text-amber-700' : 'text-blue-700'); ?>">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-clock mt-0.5 flex-shrink-0"></i>
                            <span>Có mặt tại quầy <strong>trước 30 phút</strong> so với giờ khởi hành.</span>
                        </li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->tickets->isNotEmpty()): ?>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-ticket-alt mt-0.5 flex-shrink-0"></i>
                            <span>Xuất trình <strong>mã vé điện tử</strong>:
                                <span class="font-mono font-bold"><?php echo e($booking->tickets->pluck('ticket_code')->join(', ')); ?></span>
                                — hoặc CCCD/Hộ chiếu.
                            </span>
                        </li>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-0.5 flex-shrink-0"></i>
                            <span>Điểm đón: <strong><?php echo e($booking->pickupPoint->name ?? 'Chưa xác định'); ?></strong>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->pickupPoint?->address): ?>
                                — <?php echo e($booking->pickupPoint->address); ?>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>
                        </li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->dropoffPoint): ?>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-flag-checkered mt-0.5 flex-shrink-0"></i>
                            <span>Điểm trả khách: <strong><?php echo e($booking->dropoffPoint->name); ?></strong> — nhớ thông báo tài xế trước khi lên xe.</span>
                        </li>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-phone mt-0.5 flex-shrink-0"></i>
                            <span>Hotline nhà xe:
                                <a href="tel:<?php echo e($booking->trip->vehicle->phone_vehicles ?? ''); ?>"
                                   class="font-bold underline <?php echo e($booking->status == 'paid' ? 'text-amber-800' : 'text-blue-800'); ?>">
                                    <?php echo e($booking->trip->vehicle->phone_vehicles ?? 'Xem trên vé'); ?>

                                </a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>


            <?php
                $vehicle = $booking->trip->vehicle ?? null;
                $currentSlot = $vehicle ? $vehicle->parkingSlot : null;
                $parking = $currentSlot ? $currentSlot->parking : null;
            ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($parking && $parking->slots && $parking->slots->count() > 0): ?>
                <div class="bg-white rounded-xl shadow-sm p-6 mt-6 border border-gray-100">
                    <h3 class="font-bold text-lg border-b pb-3 mb-4 text-gray-800">Sơ đồ bãi đỗ xe hiện tại:
                        <?php echo e($parking->name); ?></h3>
                    <p class="text-sm text-gray-500 mb-6"><i class="fas fa-map-marker-alt text-amber-500 mr-2"></i>
                        <?php echo e($parking->location ?? ''); ?> - <?php echo e($parking->description ?? ''); ?></p>

                    <!-- Map Legend -->
                    <div class="flex flex-wrap items-center gap-4 mb-8 text-sm bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 bg-green-100 border border-green-300 rounded"></div> <span
                                class="font-medium text-gray-700">Trống</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 bg-red-100 border border-red-300 rounded"></div> <span
                                class="font-medium text-gray-700">Đang đỗ</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 bg-yellow-100 border border-yellow-300 rounded"></div> <span
                                class="font-medium text-gray-700">Đã đặt</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 bg-blue-500 border border-blue-600 rounded"></div> <span
                                class="font-medium text-gray-700">Vị trí xe của bạn</span>
                        </div>
                    </div>

                    <?php
                        // Group by zone, then by row and column
                        // If zone is null, group by 'Khu vực chung'
                        $zones = $parking->slots->groupBy(function ($slot) {
                            return $slot->zone ? 'Khu vực ' . $slot->zone : 'Khu vực chung';
                        });
                    ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zoneName => $zoneSlots): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="mb-8 last:mb-0">
                            <h4
                                class="font-bold text-md mb-4 text-indigo-700 bg-indigo-50 inline-block px-4 py-1.5 rounded-full">
                                <?php echo e($zoneName); ?></h4>

                            <div class="overflow-x-auto pb-4">
                                <?php
                                    $zoneMinRow = $zoneSlots->min('row');
                                    $zoneMaxRow = $zoneSlots->max('row');
                                    $zoneMinCol = $zoneSlots->min('column');
                                    $zoneMaxCol = $zoneSlots->max('column');

                                    $grid = [];
                                    foreach ($zoneSlots as $slot) {
                                        $grid[$slot->row][$slot->column] = $slot;
                                    }
                                ?>

                                <table class="border-collapse border-spacing-2 mx-auto">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($r = $zoneMinRow; $r <= $zoneMaxRow; $r++): ?>
                                        <tr>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($c = $zoneMinCol; $c <= $zoneMaxCol; $c++): ?>
                                                <td class="p-1">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($grid[$r][$c])): ?>
                                                        <?php
                                                            $slot = $grid[$r][$c];
                                                            $isMyCar = $vehicle && $slot->vehicle_id == $vehicle->id;

                                                            $bgColor = 'bg-gray-100 border-gray-300';
                                                            if ($isMyCar) {
                                                                $bgColor =
                                                                    'bg-blue-500 text-white border-blue-600 font-bold shadow-md transform scale-105';
                                                            } else {
                                                                if ($slot->status == 'available') {
                                                                    $bgColor =
                                                                        'bg-green-100 border-green-300 text-green-800';
                                                                } elseif ($slot->status == 'occupied') {
                                                                    $bgColor = 'bg-red-100 border-red-300 text-red-800';
                                                                } elseif ($slot->status == 'reserved') {
                                                                    $bgColor =
                                                                        'bg-yellow-100 border-yellow-300 text-yellow-800';
                                                                }
                                                            }
                                                        ?>
                                                        <div class="w-16 h-16 sm:w-24 sm:h-24 flex flex-col items-center justify-center border-2 rounded-xl shadow-sm <?php echo e($bgColor); ?> transition-all"
                                                            title="Vị trí: <?php echo e($slot->slot_code); ?> - Trạng thái: <?php echo e(ucfirst($slot->status)); ?>">
                                                            <span
                                                                class="text-[10px] sm:text-xs <?php echo e($isMyCar ? 'text-blue-100' : 'text-gray-500'); ?> block mb-1 uppercase font-semibold"><?php echo e($slot->slot_type); ?></span>
                                                            <span
                                                                class="font-mono text-sm sm:text-lg"><?php echo e($slot->slot_code); ?></span>
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isMyCar): ?>
                                                                <i
                                                                    class="fas fa-bus-alt mt-1 sm:mt-2 text-sm sm:text-base"></i>
                                                                <!-- Sửa lại icon xe bus hợp với hành khách -->
                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <!-- Empty space for grid gaps -->
                                                        <div class="w-16 h-16 sm:w-24 sm:h-24 bg-transparent"></div>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </td>
                                            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </tr>
                                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </table>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="mt-8 text-center">
                <a href="<?php echo e(route('customer.bookings.index')); ?>"
                    class="text-indigo-600 font-medium hover:text-indigo-800 transition-colors">
                    ← Quay lại Lịch sử đặt vé
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\customer\bookings\show.blade.php ENDPATH**/ ?>