<?php $__env->startSection('content'); ?>
    <div class="px-6 lg:px-12 py-12 max-w-7xl mx-auto space-y-12">
        <!-- Search Header -->
        <div class="glass-dark rounded-3xl p-8 flex flex-wrap items-center justify-between gap-8 border-none ring-1 ring-white/10 shadow-2xl">
            <div class="flex items-center gap-6">
                <div class="w-12 h-12 rounded-2xl liquid-gradient flex items-center justify-center">
                    <i data-lucide="search" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-black italic tracking-tight">KẾT QUẢ TÌM KIẾM</h2>
                    <p class="text-white/50 text-sm">
                        <?php echo e($trips->first()?->route->departureLocation->name ?? '...'); ?><span class="mx-2 text-brand-accent">→</span>
                        <?php echo e($trips->first()?->route->destinationLocation->name ?? '...'); ?></p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="bg-white/5 px-6 py-3 rounded-2xl border border-white/5 space-y-1">
                    <p class="text-[10px] font-bold text-white/30 uppercase tracking-widest leading-none"><?php echo e(__('date')); ?> khởi hành</p>
                    <p class="text-sm font-bold"><?php echo e(request('trip_date') ? \Carbon\Carbon::parse(request('trip_date'))->format('d/m/Y') : 'Hôm nay'); ?></p>
                </div>
                <a href="<?php echo e(route('customer.home')); ?>" class="glass px-6 py-4 rounded-2xl text-sm font-bold hover:bg-white hover:text-brand-dark transition-all">
                    Thay đổi
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            <!-- Sidebar Filters -->
            <aside class="space-y-8">
                <div class="space-y-4">
                    <h4 class="text-xs font-black uppercase tracking-widest text-brand-accent">Bộ lọc</h4>
                    <div class="glass-dark rounded-3xl p-6 border-none ring-1 ring-white/5 space-y-6">
                        <!-- Hour Filter -->
                        <div class="space-y-4">
                            <p class="text-sm font-bold"><?php echo e(__('time')); ?> khởi hành</p>
                            <div class="space-y-2">
                                <label class="flex items-center gap-3 text-white/50 hover:text-white cursor-pointer transition-colors">
                                    <input type="checkbox" class="w-5 h-5 rounded-lg border-white/10 bg-white/5 text-brand-primary focus:ring-brand-primary">
                                    <span class="text-sm"><?php echo e(__('morning')); ?> (00:00 - 12:00)</span>
                                </label>
                                <label class="flex items-center gap-3 text-white/50 hover:text-white cursor-pointer transition-colors">
                                    <input type="checkbox" class="w-5 h-5 rounded-lg border-white/10 bg-white/5 text-brand-primary focus:ring-brand-primary">
                                    <span class="text-sm"><?php echo e(__('afternoon')); ?> (12:00 - 18:00)</span>
                                </label>
                                <label class="flex items-center gap-3 text-white/50 hover:text-white cursor-pointer transition-colors">
                                    <input type="checkbox" class="w-5 h-5 rounded-lg border-white/10 bg-white/5 text-brand-primary focus:ring-brand-primary">
                                    <span class="text-sm"><?php echo e(__('evening')); ?> (18:00 - 24:00)</span>
                                </label>
                            </div>
                        </div>

                        <hr class="border-white/5">

                        <!-- Bus Type -->
                        <div class="space-y-4">
                            <p class="text-sm font-bold">Loại xe</p>
                            <div class="space-y-2">
                                <label class="flex items-center gap-3 text-white/50 hover:text-white cursor-pointer transition-colors">
                                    <input type="checkbox" class="w-5 h-5 rounded-lg border-white/10 bg-white/5 text-brand-primary focus:ring-brand-primary">
                                    <span class="text-sm">Limousine</span>
                                </label>
                                <label class="flex items-center gap-3 text-white/50 hover:text-white cursor-pointer transition-colors">
                                    <input type="checkbox" class="w-5 h-5 rounded-lg border-white/10 bg-white/5 text-brand-primary focus:ring-brand-primary">
                                    <span class="text-sm">Giường nằm</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Promo Card -->
                <div class="liquid-gradient rounded-3xl p-6 space-y-4 shadow-xl shadow-brand-primary/20">
                    <i data-lucide="tag" class="w-8 h-8 opacity-50"></i>
                    <h5 class="font-bold leading-tight uppercase">Ưu đãi giảm giá 20% cho khách hàng mới!</h5>
                    <button class="w-full py-2.5 rounded-xl bg-white text-brand-dark font-black text-xs"><?php echo e(__('copy_secure_key')); ?></button>
                </div>
            </aside>

            <!-- Results Listing -->
            <div class="lg:col-span-3 space-y-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trips->isEmpty()): ?>
                    <div class="glass-dark rounded-4xl p-20 flex flex-col items-center text-center space-y-6 border-none ring-1 ring-white/10">
                        <div class="w-24 h-24 rounded-full bg-white/5 flex items-center justify-center mb-4">
                            <i data-lucide="bus" class="w-12 h-12 text-white/20"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Rất tiếc, không tìm thấy chuyến xe!</h3>
                        <p class="text-white/40 max-w-sm">Chúng tôi hiện chưa có chuyến xe nào cho tuyến đường và ngày bạn chọn. Vui lòng thử lại với ngày khác.</p>
                        <a href="<?php echo e(route('customer.home')); ?>" class="liquid-gradient px-8 py-4 rounded-2xl font-black italic">VỀ TRANG CHỦ</a>
                    </div>
                <?php else: ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div 
                            x-data="{ show: false }" 
                            x-init="setTimeout(() => show = true, <?php echo e(($index + 1) * 100); ?>)"
                            x-show="show"
                            x-transition:enter="transition ease-apple duration-700"
                            x-transition:enter-start="opacity-0 translate-y-8"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="group relative glass-dark rounded-3xl p-1 overflow-hidden transition-all duration-500 hover:ring-2 hover:ring-brand-accent/30 shadow-xl"
                        >
                            <div class="bg-brand-dark/40 rounded-[calc(1.5rem-2px)] p-6 lg:p-8 flex flex-col lg:flex-row items-center gap-10">
                                <!-- Time Track -->
                                <div class="flex items-center gap-8 shrink-0">
                                    <div class="text-center space-y-1">
                                        <p class="text-[10px] font-black uppercase text-white/30 tracking-widest">Khởi hành</p>
                                        <p class="text-3xl font-black font-heading"><?php echo e(\Carbon\Carbon::parse($trip->departure_time)->format('H:i')); ?></p>
                                    </div>
                                    
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-1.5 h-1.5 rounded-full bg-brand-accent shadow-[0_0_10px_rgba(34,211,238,0.5)]"></div>
                                        <div class="h-10 w-px border-l border-dashed border-white/20"></div>
                                        <div class="w-1.5 h-1.5 rounded-full bg-white/20"></div>
                                        <p class="absolute -translate-y-6 text-[10px] font-bold text-white/20 uppercase tracking-tighter">
                                            <?php echo e($trip->route->estimated_time ? $trip->route->estimated_time . 'H' : '...'); ?></p>
                                    </div>

                                    <div class="text-center space-y-1">
                                        <p class="text-[10px] font-black uppercase text-white/30 tracking-widest">Dự kiến</p>
                                        <p class="text-3xl font-black font-heading text-white/40"><?php echo e(\Carbon\Carbon::parse($trip->arrival_time)->format('H:i')); ?></p>
                                    </div>
                                </div>

                                <!-- Bus Info -->
                                <div class="flex-1 space-y-4">
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-3 py-1 rounded-full bg-brand-primary/20 text-brand-primary text-[10px] font-black uppercase tracking-widest border border-brand-primary/30">
                                            <?php echo e($trip->vehicle->type ?? 'Luxury'); ?></span>
                                        <span class="px-3 py-1 rounded-full bg-white/5 text-white/50 text-[10px] font-black uppercase tracking-widest border border-white/5">
                                            <?php echo e($trip->vehicle->license_plate); ?></span>
                                    </div>
                                    <h4 class="text-xl font-bold font-heading">Nhà xe Mạnh Hùng Premium</h4>
                                    <div class="flex items-center gap-4 text-xs text-white/40 font-medium">
                                        <div class="flex items-center gap-1.5">
                                            <i data-lucide="zap" class="w-3.5 h-3.5 text-brand-accent"></i>
                                            <span>Wifi Free</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <i data-lucide="coffee" class="w-3.5 h-3.5 text-brand-accent"></i>
                                            <span>Nước suối</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price & Action -->
                                <div class="w-full lg:w-auto flex flex-row lg:flex-col items-center justify-between lg:justify-center gap-6 lg:pl-10 lg:border-l lg:border-white/5 shrink-0">
                                    <div class="text-right lg:text-center space-y-1">
                                        <p class="text-3xl font-black italic text-brand-accent"><?php echo e(number_format($trip->price, 0, ',', '.')); ?>đ</p>
                                        <p class="text-[10px] font-bold text-white/30 uppercase tracking-widest">Mỗi hành khách</p>
                                    </div>
                                    <div class="space-y-3">
                                        <a href="<?php echo e(route('customer.trips.show', $trip->id)); ?>" class="inline-flex items-center px-8 py-4 rounded-2xl liquid-gradient font-black italic shadow-lg shadow-brand-primary/20 hover:scale-[1.05] active:scale-[0.98] transition-all">
                                            CHỌN CHỖ
                                        </a>
                                        <p class="text-center text-[10px] font-bold text-white/40 group-hover:text-brand-accent transition-colors">
                                            CÒN <?php echo e(max(0, ($trip->vehicle->total_seats ?? 0) - ($trip->seat_locks_count ?? 0))); ?> GHẾ TRỐNG
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Reveal animation delay could be handled here or via Alpine
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\code\laragon\www\du-an-tot-nghiep\resources\views/customer/trips/search_result.blade.php ENDPATH**/ ?>