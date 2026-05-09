<?php $__env->startSection('content-main'); ?>
    <!-- Hero Section -->
    <section class="relative pt-24 pb-32 lg:pt-36 lg:pb-48 overflow-hidden">
        <!-- Background Image/Gradient -->
        <div class="absolute inset-0 z-0">
            <!-- Tăng opacity và bỏ mix-blend-overlay để ảnh sinh động hơn -->
            <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=2069&auto=format&fit=crop" alt="Bus background" class="w-full h-full object-cover opacity-50">
            <!-- Lớp phủ màu đen Gradient đậm hơn để chữ nổi bật -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/60 to-[#0a0a0a]/30"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 text-center">
            
            <!-- Promo Banner -->
            <div class="inline-flex items-center gap-3 bg-brand-primary/20 border border-brand-primary/50 backdrop-blur-md rounded-full px-6 py-2 mb-8 shadow-[0_0_20px_rgba(255,91,36,0.3)] animate-bounce">
                <span class="text-xl">🔥</span>
                <p class="font-bold text-white text-sm tracking-wide">Giảm 20% cho khách hàng mới - Nhập mã: <span class="text-brand-accent">MANHHUNG20</span></p>
            </div>

            <h1 class="text-5xl md:text-7xl font-black font-heading mb-6 tracking-tight drop-shadow-2xl text-white">
                Hành trình trọn vẹn, <br class="hidden md:block" />
                <span class="liquid-text drop-shadow-none">An toàn tuyệt đối</span>
            </h1>
            <p class="text-white/90 text-lg md:text-xl font-medium max-w-2xl mx-auto mb-12 drop-shadow-md">
                Hệ thống đặt vé xe trực tuyến hàng đầu. Chọn chỗ, thanh toán nhanh chóng chỉ trong 30 giây.
            </p>

            <!-- Search Form (Vibrant Glassmorphism) -->
            <div class="bg-black/40 backdrop-blur-2xl p-6 md:p-8 rounded-3xl max-w-5xl mx-auto shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-white/20 relative overflow-hidden">
                <!-- Ánh sáng hắt (Glow effect) -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-brand-primary/30 rounded-full blur-[80px] pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-brand-accent/20 rounded-full blur-[80px] pointer-events-none"></div>

                <form action="<?php echo e(route('customer.trips.search')); ?>" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-5 items-end relative z-10">
                    
                    <!-- Điểm đi -->
                    <div class="text-left relative">
                        <label class="block text-sm font-bold text-white mb-2 ml-1">Điểm đi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none group-focus-within:text-brand-accent transition-colors text-white/50">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <select name="start_location_id" required class="w-full bg-white/10 border border-white/20 hover:border-brand-primary/50 rounded-xl py-4 pl-11 pr-4 text-white font-medium focus:outline-none focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/50 appearance-none transition-all cursor-pointer">
                                <option value="" class="bg-[#0a0a0a] text-white/50">Chọn điểm đi</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($location->id); ?>" class="bg-[#0a0a0a] text-white"><?php echo e($location->name); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-white/50 group-hover:text-white transition-colors">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Điểm đến -->
                    <div class="text-left relative">
                        <label class="block text-sm font-bold text-white mb-2 ml-1">Điểm đến</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none group-focus-within:text-brand-primary transition-colors text-white/50">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <select name="end_location_id" required class="w-full bg-white/10 border border-white/20 hover:border-brand-primary/50 rounded-xl py-4 pl-11 pr-4 text-white font-medium focus:outline-none focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/50 appearance-none transition-all cursor-pointer">
                                <option value="" class="bg-[#0a0a0a] text-white/50">Chọn điểm đến</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($location->id); ?>" class="bg-[#0a0a0a] text-white"><?php echo e($location->name); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-white/50 group-hover:text-white transition-colors">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Ngày đi -->
                    <div class="text-left relative">
                        <label class="block text-sm font-bold text-white mb-2 ml-1">Ngày đi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none group-focus-within:text-brand-primary transition-colors text-white/50">
                                <i data-lucide="calendar" class="w-5 h-5"></i>
                            </div>
                            <input type="date" name="trip_date" min="<?php echo e(date('Y-m-d')); ?>" class="w-full bg-white/10 border border-white/20 hover:border-brand-primary/50 rounded-xl py-4 pl-11 pr-4 text-white font-medium focus:outline-none focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/50 appearance-none transition-all cursor-pointer [color-scheme:dark]">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full liquid-gradient hover:scale-[1.02] active:scale-[0.98] transition-transform py-4 rounded-xl text-white font-black text-lg flex items-center justify-center gap-2 shadow-[0_10px_30px_rgba(255,91,36,0.5)] border border-[#ff5b24]/50">
                            <i data-lucide="search" class="w-5 h-5"></i>
                            Tìm chuyến xe
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 relative border-y border-white/10">
        <div class="absolute inset-0 bg-[#050505]"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 text-center">
                <div class="bg-[#0a0a0a] border border-white/5 p-8 rounded-3xl hover:border-brand-primary/50 hover:shadow-[0_0_30px_rgba(255,91,36,0.15)] hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-20 h-20 rounded-full bg-brand-primary/10 border border-brand-primary/20 flex items-center justify-center mx-auto mb-6 text-brand-primary group-hover:scale-110 group-hover:bg-brand-primary/20 transition-all">
                        <i data-lucide="zap" class="w-10 h-10"></i>
                    </div>
                    <h3 class="text-2xl font-black mb-3 text-white tracking-tight">Đặt vé siêu tốc</h3>
                    <p class="text-white/60 text-base leading-relaxed">Chỉ với 3 bước đơn giản, bạn có thể chọn được chỗ ngồi ưng ý và thanh toán trong chưa đầy 30 giây.</p>
                </div>

                <div class="bg-[#0a0a0a] border border-white/5 p-8 rounded-3xl hover:border-brand-accent/50 hover:shadow-[0_0_30px_rgba(255,184,0,0.15)] hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-20 h-20 rounded-full bg-brand-accent/10 border border-brand-accent/20 flex items-center justify-center mx-auto mb-6 text-brand-accent group-hover:scale-110 group-hover:bg-brand-accent/20 transition-all">
                        <i data-lucide="shield-check" class="w-10 h-10"></i>
                    </div>
                    <h3 class="text-2xl font-black mb-3 text-white tracking-tight">Thanh toán an toàn</h3>
                    <p class="text-white/60 text-base leading-relaxed">Tích hợp đa dạng cổng thanh toán, đảm bảo bảo mật thông tin tuyệt đối cho mọi giao dịch của bạn.</p>
                </div>

                <div class="bg-[#0a0a0a] border border-white/5 p-8 rounded-3xl hover:border-purple-500/50 hover:shadow-[0_0_30px_rgba(168,85,247,0.15)] hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-20 h-20 rounded-full bg-purple-500/10 border border-purple-500/20 flex items-center justify-center mx-auto mb-6 text-purple-400 group-hover:scale-110 group-hover:bg-purple-500/20 transition-all">
                        <i data-lucide="clock" class="w-10 h-10"></i>
                    </div>
                    <h3 class="text-2xl font-black mb-3 text-white tracking-tight">Đúng giờ xuất bến</h3>
                    <p class="text-white/60 text-base leading-relaxed">Cam kết lịch trình chặt chẽ, khởi hành đúng khung giờ như trên vé bạn đã chọn.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Routes -->
    <section id="routes" class="py-24 relative overflow-hidden">
        <div class="absolute top-1/2 left-0 w-96 h-96 bg-brand-primary/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-brand-accent/5 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <h2 class="text-4xl font-black font-heading text-white mb-4 tracking-tight">Tuyến Đường Phổ Biến</h2>
                    <p class="text-white/70 max-w-2xl text-lg">Những chuyến đi được khách hàng lựa chọn nhiều nhất. Trải nghiệm dịch vụ xe Limousine cao cấp với giá cả hợp lý.</p>
                </div>
                <a href="#search" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 border border-white/20 rounded-full text-white hover:bg-white hover:text-black transition-all font-bold group">
                    Xem tất cả chuyến <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <?php
                $hanoiId = $locations->firstWhere('name', 'Hà Nội')?->id ?? 1;
                $danangId = $locations->firstWhere('name', 'Đà Nẵng')?->id ?? 3;
                $hcmId = $locations->firstWhere('name', 'TP. Hồ Chí Minh')?->id ?? 2;
                $dalatId = $locations->firstWhere('name', 'Đà Lạt')?->id ?? 7;
                $nhatrangId = $locations->firstWhere('name', 'Nha Trang')?->id ?? 6;
                $sapaId = $locations->firstWhere('name', 'Sapa')?->id ?? 1;
            ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Route Card 1 -->
                <div class="group rounded-3xl bg-[#050505] border border-white/10 overflow-hidden hover:border-brand-primary/50 transition-all duration-300 hover:shadow-[0_10px_30px_rgba(255,91,36,0.15)] flex flex-col h-full">
                    <div class="h-56 overflow-hidden relative">
                        <img src="./images/hanoi-17486566616582033334984.jpg" onerror="this.src='https://images.unsplash.com/photo-1596423735880-5f2a689b903e?q=80&w=2070&auto=format&fit=crop'" alt="Hanoi to Danang" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#050505] to-transparent"></div>
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1.5 text-xs font-black uppercase tracking-wider bg-brand-primary text-white rounded-lg shadow-lg">Limousine</span>
                            <span class="px-3 py-1.5 text-xs font-black uppercase tracking-wider bg-black/50 backdrop-blur-md text-brand-accent border border-brand-accent/50 rounded-lg shadow-lg">Hot</span>
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="font-black text-xl text-white">Hà Nội</span>
                            <i data-lucide="arrow-right" class="w-5 h-5 text-brand-primary"></i>
                            <span class="font-black text-xl text-white">Đà Nẵng</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/60 text-sm mb-6 font-medium">
                            <i data-lucide="tag" class="w-4 h-4"></i> Từ 350.000đ <span class="mx-2">•</span> <i data-lucide="clock" class="w-4 h-4"></i> 14 chuyến/ngày
                        </div>
                        <a href="<?php echo e(route('customer.trips.search', ['start_location_id' => $hanoiId, 'end_location_id' => $danangId, 'trip_date' => date('Y-m-d')])); ?>" class="mt-auto w-full py-3.5 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-brand-primary hover:border-brand-primary transition-all inline-block text-center flex items-center justify-center gap-2 group/btn">
                            Đặt vé tuyến này <i data-lucide="arrow-right" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Route Card 2 -->
                <div class="group rounded-3xl bg-[#050505] border border-white/10 overflow-hidden hover:border-brand-primary/50 transition-all duration-300 hover:shadow-[0_10px_30px_rgba(255,91,36,0.15)] flex flex-col h-full">
                    <div class="h-56 overflow-hidden relative">
                        <img src="./images/39-4595-6687.jpg" onerror="this.src='https://images.unsplash.com/photo-1620914949504-f5979eb46d03?q=80&w=1974&auto=format&fit=crop'" alt="HCM to Dalat" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#050505] to-transparent"></div>
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1.5 text-xs font-black uppercase tracking-wider bg-brand-accent text-brand-dark rounded-lg shadow-lg">Giường nằm</span>
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="font-black text-xl text-white">Sài Gòn</span>
                            <i data-lucide="arrow-right" class="w-5 h-5 text-brand-primary"></i>
                            <span class="font-black text-xl text-white">Đà Lạt</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/60 text-sm mb-6 font-medium">
                            <i data-lucide="tag" class="w-4 h-4"></i> Từ 250.000đ <span class="mx-2">•</span> <i data-lucide="clock" class="w-4 h-4"></i> 20 chuyến/ngày
                        </div>
                        <a href="<?php echo e(route('customer.trips.search', ['start_location_id' => $hcmId, 'end_location_id' => $dalatId, 'trip_date' => date('Y-m-d')])); ?>" class="mt-auto w-full py-3.5 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-brand-primary hover:border-brand-primary transition-all inline-block text-center flex items-center justify-center gap-2 group/btn">
                            Đặt vé tuyến này <i data-lucide="arrow-right" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Route Card 3 -->
                <div class="group rounded-3xl bg-[#050505] border border-white/10 overflow-hidden hover:border-brand-primary/50 transition-all duration-300 hover:shadow-[0_10px_30px_rgba(255,91,36,0.15)] flex flex-col h-full">
                    <div class="h-56 overflow-hidden relative">
                        <img src="./images/du-lich-sapa.jpg" onerror="this.src='https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?q=80&w=2105&auto=format&fit=crop'" alt="Hanoi to Sapa" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#050505] to-transparent"></div>
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1.5 text-xs font-black uppercase tracking-wider bg-brand-primary text-white rounded-lg shadow-lg">Limousine VIP</span>
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="font-black text-xl text-white">Hà Nội</span>
                            <i data-lucide="arrow-right" class="w-5 h-5 text-brand-primary"></i>
                            <span class="font-black text-xl text-white">Sapa</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/60 text-sm mb-6 font-medium">
                            <i data-lucide="tag" class="w-4 h-4"></i> Từ 300.000đ <span class="mx-2">•</span> <i data-lucide="clock" class="w-4 h-4"></i> 10 chuyến/ngày
                        </div>
                        <a href="<?php echo e(route('customer.trips.search', ['start_location_id' => $hanoiId, 'end_location_id' => $sapaId, 'trip_date' => date('Y-m-d')])); ?>" class="mt-auto w-full py-3.5 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-brand-primary hover:border-brand-primary transition-all inline-block text-center flex items-center justify-center gap-2 group/btn">
                            Đặt vé tuyến này <i data-lucide="arrow-right" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Route Card 4 -->
                <div class="group rounded-3xl bg-[#050505] border border-white/10 overflow-hidden hover:border-brand-primary/50 transition-all duration-300 hover:shadow-[0_10px_30px_rgba(255,91,36,0.15)] flex flex-col h-full">
                    <div class="h-56 overflow-hidden relative">
                        <img src="./images/z6223362576777_15a21ef00a73b25851a3972d86795475_20250113104122.jpg" onerror="this.src='https://images.unsplash.com/photo-1582035315357-d4ed79426d83?q=80&w=1974&auto=format&fit=crop'" alt="HCM to Nha Trang" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#050505] to-transparent"></div>
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1.5 text-xs font-black uppercase tracking-wider bg-brand-accent text-brand-dark rounded-lg shadow-lg">Giường nằm</span>
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="font-black text-xl text-white">Sài Gòn</span>
                            <i data-lucide="arrow-right" class="w-5 h-5 text-brand-primary"></i>
                            <span class="font-black text-xl text-white">Nha Trang</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/60 text-sm mb-6 font-medium">
                            <i data-lucide="tag" class="w-4 h-4"></i> Từ 280.000đ <span class="mx-2">•</span> <i data-lucide="clock" class="w-4 h-4"></i> 15 chuyến/ngày
                        </div>
                        <a href="<?php echo e(route('customer.trips.search', ['start_location_id' => $hcmId, 'end_location_id' => $nhatrangId, 'trip_date' => date('Y-m-d')])); ?>" class="mt-auto w-full py-3.5 rounded-xl bg-white/5 border border-white/10 text-white font-bold hover:bg-brand-primary hover:border-brand-primary transition-all inline-block text-center flex items-center justify-center gap-2 group/btn">
                            Đặt vé tuyến này <i data-lucide="arrow-right" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/customer/home/index.blade.php ENDPATH**/ ?>