<?php $__env->startSection('content'); ?>
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold">Điều phối Check-in</h1>
        <p class="text-gray-500 italic">Theo dõi luồng khách: Tuyến đường &rarr; Chuyến xe &rarr; Hành khách.</p>
    </div>
    <div class="flex gap-2">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('trip_id')): ?>
            <a href="<?php echo e(route('staff.checkin.index', ['route_id' => request('route_id')])); ?>" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
                &lsaquo; Đổi xe khác
            </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('route_id')): ?>
            <a href="<?php echo e(route('staff.checkin.index')); ?>" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
                &laquo; Chọn Tuyến khác
            </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

<!-- TÌM KIẾM NHANH (Luôn hiển thị) -->
<div class="bg-white dark:bg-[#111111] p-4 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626] mb-8">
    <form action="<?php echo e(route('staff.checkin.index')); ?>" method="GET" class="flex flex-col md:flex-row gap-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('route_id')): ?> <input type="hidden" name="route_id" value="<?php echo e(request('route_id')); ?>"> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('trip_id')): ?> <input type="hidden" name="trip_id" value="<?php echo e(request('trip_id')); ?>"> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <div class="grow">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Tìm nhanh SĐT / Mã vé bất kỳ..." class="w-full px-4 py-2 bg-gray-50 dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#262626] rounded-xl font-bold outline-none focus:ring-2 focus:ring-blue-500 transition-all">
        </div>
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-md transition-all">Tìm nhanh</button>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search') || request('route_id') || request('trip_id')): ?>
            <a href="<?php echo e(route('staff.checkin.index')); ?>" class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl font-bold flex items-center justify-center italic text-xs">Xóa lọc</a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </form>
</div>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!request('route_id') && !request('search')): ?>
    <!-- BƯỚC 1: CHỌN TUYẾN ĐƯỜNG -->
    <div class="mb-6">
        <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
            <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
            Bước 1: Chọn Tuyến đường vận hành
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <a href="<?php echo e(route('staff.checkin.index', ['route_id' => $route->id])); ?>" class="bg-white dark:bg-[#111111] p-6 rounded-3xl border-2 border-transparent hover:border-blue-500 shadow-sm transition-all group">
                    <div class="text-[10px] font-black opacity-30 uppercase mb-2">Chuyến đi</div>
                    <div class="text-lg font-black leading-tight group-hover:text-blue-600 transition-colors">
                        <?php echo e($route->startLocation->name); ?> <br>
                        <span class="text-blue-500">&rarr;</span> <?php echo e($route->endLocation->name); ?>

                    </div>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="col-span-full py-20 text-center opacity-40 italic font-bold">Hiện không có tuyến đường nào có lịch trình sắp tới.</div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

<?php elseif(request('route_id') && !request('trip_id') && !request('search')): ?>
    <!-- BƯỚC 2: CHỌN XE / CHUYẾN CỤ THỂ -->
    <div class="mb-6">
        <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
            <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
            Bước 2: Chọn xe đang làm lệnh (<?php echo e($selectedRoute->startLocation->name); ?> &rarr; <?php echo e($selectedRoute->endLocation->name); ?>)
        </h2>

        <?php
            $statusLabels = [
                'departing' => ['label' => 'ĐANG KHỞI HÀNH', 'color' => 'bg-red-500', 'bg' => 'bg-red-50 dark:bg-red-950/20'],
                'ready' => ['label' => 'CHUẨN BỊ CHẠY', 'color' => 'bg-orange-500', 'bg' => 'bg-orange-50 dark:bg-orange-950/20'],
                'upcoming' => ['label' => 'SẮP TỚI', 'color' => 'bg-blue-500', 'bg' => 'bg-gray-50 dark:bg-gray-900/40'],
                'departed' => ['label' => 'ĐÃ KHỞI HÀNH', 'color' => 'bg-gray-500', 'bg' => 'bg-gray-100 dark:bg-gray-800/40']
            ];
        ?>

        <div class="space-y-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['departing', 'ready', 'upcoming', 'departed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <?php $filteredTrips = $trips->where('operational_status', $status); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filteredTrips->count() > 0): ?>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <span class="px-3 py-1 <?php echo e($statusLabels[$status]['color']); ?> text-white text-[10px] font-black rounded-lg"><?php echo e($statusLabels[$status]['label']); ?></span>
                            <div class="grow h-px bg-gray-100 dark:bg-gray-800"></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filteredTrips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <div class="<?php echo e($statusLabels[$status]['bg']); ?> p-6 rounded-3xl border border-transparent hover:border-current transition-all group">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="text-2xl font-black"><?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('H:i')); ?></div>
                                        <div class="text-xs font-bold opacity-60 uppercase"><?php echo e(\Carbon\Carbon::parse($trip->trip_date)->format('d/m')); ?></div>
                                    </div>
                                    <div class="mb-6">
                                        <div class="text-sm font-bold"><?php echo e($trip->vehicle->license_plate ?? 'BKS-???'); ?></div>
                                        <div class="text-xs opacity-60 italic"><?php echo e($trip->driver->name ?? 'Chưa gán tài xế'); ?></div>
                                    </div>
                                    <a href="<?php echo e(route('staff.checkin.index', ['route_id' => request('route_id'), 'trip_id' => $trip->id])); ?>" class="w-full py-3 bg-white dark:bg-black rounded-2xl text-center text-sm font-black shadow-sm group-hover:shadow-lg transition-all block">
                                        VÀO ĐIỂM DANH &rarr;
                                    </a>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>

<?php else: ?>
    <!-- BƯỚC 3: DANH SÁCH HÀNH KHÁCH -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('trip_id') && !request('search')): ?>
        <div class="mb-6 p-4 bg-blue-600 text-white rounded-2xl shadow-lg flex items-center justify-between">
            <div>
                <div class="text-[10px] font-black opacity-60 uppercase">Đang check-in xe</div>
                <div class="text-lg font-black"><?php echo e($tickets->first()?->trip?->vehicle?->license_plate ?? '???'); ?> | Chuyến <?php echo e($tickets->first()?->trip?->departure_time ?? '--:--'); ?></div>
            </div>
            <div class="text-right">
                <div class="text-[10px] font-black opacity-60 uppercase">Tổng khách</div>
                <div class="text-2xl font-black"><?php echo e($tickets->total()); ?></div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="flex flex-wrap gap-2 mb-6">
        <?php
            $statusTabs = ['' => 'Tất cả', 'pending' => 'Chưa lên', 'used' => 'Đã lên', 'no_show' => 'Vắng'];
        ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statusTabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <a href="<?php echo e(request()->fullUrlWithQuery(['status' => $val])); ?>" 
               class="px-5 py-2.5 rounded-xl text-xs font-black transition-all <?php echo e((request('status', '') == (string)$val) ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-white dark:bg-[#111] border border-[#e3e3e0] dark:border-[#262626]'); ?>">
                <?php echo e($tab['label'] ?? $label); ?>

            </a>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>

    <div class="bg-white dark:bg-[#111111] rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626] overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 dark:bg-[#1a1a1a] text-[10px] uppercase opacity-40 font-black tracking-widest border-b border-[#e3e3e0] dark:border-[#262626]">
                <tr>
                    <th class="px-6 py-4">Ghế</th>
                    <th class="px-6 py-4">Khách hàng</th>
                    <th class="px-6 py-4">Trạng thái</th>
                    <th class="px-6 py-4 text-center">Xử lý</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#262626]">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-[#161616] transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-xl font-black text-blue-600"><?php echo e($ticket->seat?->seat_number ?? '?'); ?></div>
                            <div class="text-[10px] font-mono opacity-40"><?php echo e($ticket->ticket_code); ?></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold"><?php echo e($ticket->booking?->contact_name ?? 'N/A'); ?></div>
                            <div class="text-xs text-blue-500 font-bold"><?php echo e($ticket->booking?->contact_phone ?? 'N/A'); ?></div>
                        </td>
                        <td class="px-6 py-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ticket->status === 'used'): ?>
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-[10px] font-black uppercase italic">ĐÃ LÊN XE</span>
                            <?php elseif($ticket->status === 'no_show'): ?>
                                <span class="px-3 py-1 bg-red-100 text-red-600 rounded-lg text-[10px] font-black uppercase italic">VẮNG MẶT</span>
                            <?php elseif($ticket->booking?->status !== 'paid'): ?>
                                <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-[10px] font-black uppercase animate-pulse">CHƯA TRẢ TIỀN</span>
                            <?php else: ?>
                                <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg text-[10px] font-black uppercase">CHỜ ĐẾN</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($ticket->status, ['used', 'no_show'])): ?>
                                    <form action="<?php echo e(route('staff.checkin.reset', $ticket)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" onclick="return confirm('Hoàn tác trạng thái vé này?')" class="text-[10px] text-orange-500 font-bold italic py-2 hover:underline">Hoàn tác</button>
                                    </form>
                                <?php elseif($ticket->booking?->status === 'paid'): ?>
                                    <form action="<?php echo e(route('staff.checkin.process', $ticket)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-xl text-xs font-black shadow-md hover:scale-105 transition-all">LÊN XE</button>
                                    </form>
                                    <button type="button" 
                                            onclick="openNoShowModal('<?php echo e($ticket->booking?->contact_name); ?>', '<?php echo e($ticket->booking?->contact_phone); ?>', '<?php echo e(route('staff.checkin.noshow', $ticket)); ?>')" 
                                            class="px-4 py-2 bg-red-50 text-red-600 rounded-xl text-xs font-bold hover:bg-red-100 italic transition-all">
                                        Vắng
                                    </button>
                                <?php else: ?>
                                    <form action="<?php echo e(route('staff.bookings.confirm', $ticket->booking)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-black shadow-md hover:scale-105 transition-all">THU TIỀN</button>
                                    </form>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="4" class="px-6 py-20 text-center opacity-40 italic">Không có dữ liệu.</td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-8">
        <?php echo e($tickets->links()); ?>

    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<!-- Shared Modal (No-Show Verification) -->
<div id="noShowModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-[#111] w-full max-w-md rounded-3xl shadow-2xl p-8 text-center animate-in zoom-in-95 duration-200">
        <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/></svg>
        </div>
        <h3 class="text-xl font-black mb-2 uppercase">GỌI ĐIỆN XÁC MINH</h3>
        <p class="text-[11px] text-gray-500 mb-6 italic">Hãy gọi xác nhận 2-3 lần trước khi đánh dấu vắng.</p>
        
        <div class="bg-gray-50 dark:bg-[#0a0a0a] border border-gray-100 dark:border-[#222] p-6 rounded-2xl mb-6">
            <div id="modalCustomerName" class="text-lg font-bold mb-3">...</div>
            <a id="modalCustomerPhone" href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-xl font-black shadow-lg hover:scale-105 transition-all text-sm uppercase italic">
                BẮM ĐỂ GỌI NGAY
            </a>
        </div>

        <div class="flex gap-4">
            <button onclick="closeNoShowModal()" class="w-1/2 py-4 font-bold text-gray-400">Bỏ qua</button>
            <form id="noShowForm" action="#" method="POST" class="w-1/2">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-black active:scale-95 transition-all">CHỐT VẮNG</button>
            </form>
        </div>
    </div>
</div>

<script>
function openNoShowModal(name, phone, actionUrl) {
    document.getElementById('modalCustomerName').innerText = name;
    document.getElementById('modalCustomerPhone').href = 'tel:' + phone;
    document.getElementById('noShowForm').action = actionUrl;
    document.getElementById('noShowModal').classList.remove('hidden');
}
function closeNoShowModal() {
    document.getElementById('noShowModal').classList.add('hidden');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.staff', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\staff\checkin\index.blade.php ENDPATH**/ ?>