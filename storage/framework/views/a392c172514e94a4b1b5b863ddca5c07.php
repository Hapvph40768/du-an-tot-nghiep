<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section id="booking" class="relative min-h-[90vh] flex items-center justify-center pt-16 overflow-hidden">
        <!-- Hero Image with Parallax-ready styling -->
        <div class="absolute inset-0 z-0">
            <img src="/images/hero-bg.png" alt="Luxury Coach" class="w-full h-full object-cover opacity-60 scale-105">
            <div class="absolute inset-0 bg-gradient-to-b from-brand-dark/20 via-brand-dark/40 to-brand-dark"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Left: Value Prop -->
            <div class="space-y-8" x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)">
                <div x-show="show" x-transition:enter="transition ease-apple duration-1000"
                    x-transition:enter-start="opacity-0 -translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                    <span
                        class="inline-block px-4 py-1.5 rounded-full glass text-brand-accent text-xs font-bold tracking-widest uppercase mb-6">
                        Luxury Travel Experience
                    </span>
                    <h1 class="text-6xl lg:text-8xl font-black leading-[0.9] mb-6">
                        ĐẶT VÉ NHANH <br />
                        <span class="liquid-text font-black">CHỈ 30 GIÂY</span>
                    </h1>
                    <p class="text-xl text-white/60 max-w-lg leading-relaxed">
                        Trải nghiệm dịch vụ vận tải 5 sao với dàn xe Limousine đời mới. Chọn tuyến, chọn ghế và khởi hành
                        ngay lập tức.
                    </p>
                </div>

                <div x-show="show" x-transition:enter="transition ease-apple duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                    class="flex items-center gap-6">
                    <div class="flex -space-x-3">
                        <div
                            class="w-12 h-12 rounded-full border-2 border-brand-dark bg-gray-800 flex items-center justify-center font-bold text-xs ring-2 ring-white/10">
                            MH</div>
                        <div
                            class="w-12 h-12 rounded-full border-2 border-brand-dark bg-brand-primary flex items-center justify-center font-bold text-xs ring-2 ring-white/10">
                            5★</div>
                    </div>
                    <div>
                        <p class="text-sm font-bold">10,000+ Khách hàng</p>
                        <p class="text-xs text-white/40">Đã tin dùng dịch vụ của chúng tôi</p>
                    </div>
                </div>
            </div>

            <!-- Right: Search Form -->
            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)">
                <div x-show="show" x-transition:enter="transition ease-apple duration-1000 delay-500"
                    x-transition:enter-start="opacity-0 scale-95 translate-x-8"
                    x-transition:enter-end="opacity-100 scale-100 translate-x-0"
                    class="glass-dark p-10 rounded-4xl shadow-2xl relative">
                    <div
                        class="absolute -top-4 -right-4 w-12 h-12 rounded-2xl liquid-gradient flex items-center justify-center shadow-lg animate-bounce">
                        <i data-lucide="sparkles" class="w-6 h-6"></i>
                    </div>

                    <h3 class="font-heading text-2xl font-bold mb-8">Tìm chuyến xe</h3>

                    <form action="<?php echo e(route('customer.trips.search')); ?>" method="GET" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-white/40 uppercase tracking-widest">Điểm đi</label>
                                <div class="relative">
                                    <select name="start_location_id" required
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-brand-accent transition-all appearance-none">
                                        <option value="" class="bg-brand-dark">Chọn điểm đi</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                            <option value="<?php echo e($location->id); ?>" class="bg-brand-dark"><?php echo e($location->name); ?>

                                            </option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </select>
                                    <i data-lucide="map-pin"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/20"></i>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="text-xs font-bold text-white/40 uppercase tracking-widest"><?php echo e(__('destination')); ?></label>
                                <div class="relative">
                                    <select name="end_location_id" required
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-brand-accent transition-all appearance-none">
                                        <option value="" class="bg-brand-dark">Chọn điểm đến</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                            <option value="<?php echo e($location->id); ?>" class="bg-brand-dark"><?php echo e($location->name); ?>

                                            </option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </select>
                                    <i data-lucide="navigation"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/20"></i>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-white/40 uppercase tracking-widest"><?php echo e(__('date')); ?> khởi
                                hành</label>
                            <div class="relative">
                                <input type="date" name="trip_date" value="<?php echo e(date('Y-m-d')); ?>" required
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-brand-accent transition-all">
                                <i data-lucide="calendar"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/20"></i>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full py-5 rounded-2xl liquid-gradient font-black text-lg shadow-xl shadow-brand-primary/30 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                            <span>TÌM CHUYẾN XE</span>
                            <i data-lucide="arrow-right" class="w-6 h-6"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Routes -->
    <section id="routes" class="py-32 max-w-7xl mx-auto px-6 reveal">
        <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-16">
            <div class="space-y-4">
                <span class="text-brand-accent font-black tracking-widest uppercase text-xs">Hot Destinations</span>
                <h2 class="text-5xl font-black italic">TUYẾN ĐƯỜNG PHỔ BIẾN</h2>
            </div>
            <a href="#" class="group flex items-center gap-3 text-white/50 hover:text-white transition-colors">
                <span><?php echo e(__('view')); ?> tất cả</span>
                <div
                    class="w-10 h-10 rounded-full glass flex items-center justify-center group-hover:bg-brand-accent group-hover:text-white transition-all">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php
                $popular = [
                    ['from' => 'Hà Nội', 'to' => 'Đà Nẵng', 'price' => '350.000', 'img' => 'https://images.unsplash.com/photo-1555944191-2330ca0493ce?auto=format&fit=crop&q=80&w=600'],
                    ['from' => 'TP. Hồ Chí Minh', 'to' => 'Đà Lạt', 'price' => '250.000', 'img' => 'https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&q=80&w=600'],
                    ['from' => 'Hà Nội', 'to' => 'Nha Trang', 'price' => '550.000', 'img' => 'https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&q=80&w=600'],
                    ['from' => 'TP. Hồ Chí Minh', 'to' => 'Cần Thơ', 'price' => '180.000', 'img' => 'https://images.unsplash.com/photo-1598144675549-b006c9e99593?auto=format&fit=crop&q=80&w=600']
                ];

                // Helper to find ID by name
                $getLocId = fn($name) => $locations->firstWhere('name', $name)->id ?? 1;
            ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="group relative aspect-[4/5] rounded-3xl overflow-hidden glass border-none">
                    <img src="<?php echo e($route['img']); ?>"
                        class="absolute inset-0 w-full h-full object-cover grayscale brightness-50 group-hover:grayscale-0 group-hover:scale-110 group-hover:brightness-100 transition-all duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-transparent to-transparent opacity-80">
                    </div>

                    <div
                        class="absolute bottom-0 left-0 right-0 p-8 space-y-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="flex items-center gap-2 text-brand-accent text-xs font-bold tracking-widest uppercase">
                            <span><?php echo e($route['from']); ?></span>
                            <i data-lucide="arrow-right-left" class="w-3 h-3"></i>
                            <span><?php echo e($route['to']); ?></span>
                        </div>
                        <h4 class="text-2xl font-bold line-clamp-1"><?php echo e($route['from']); ?> - <?php echo e($route['to']); ?></h4>
                        <p class="text-white/60 text-sm">Chỉ từ <span class="text-white font-bold"><?php echo e($route['price']); ?>đ</span>
                        </p>

                        <div class="pt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                            <a href="<?php echo e(route('customer.trips.search', ['start_location_id' => $getLocId($route['from']), 'end_location_id' => $getLocId($route['to']), 'trip_date' => date('Y-m-d')])); ?>"
                                class="block w-full py-3 rounded-xl bg-white text-brand-dark font-black text-sm text-center transform active:scale-95 transition-transform"><?php echo e(__('bookings')); ?>

                                ngay</a>
                        </div>
                    </div>

                    <div
                        class="absolute top-6 right-6 w-10 h-10 rounded-full glass flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all scale-75 group-hover:scale-100">
                        <i data-lucide="heart" class="w-5 h-5 text-white"></i>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-32 bg-white/5 relative overflow-hidden reveal">
        <div class="absolute -left-24 top-1/2 -translate-y-1/2 w-64 h-64 bg-brand-primary/10 blur-[100px] rounded-full">
        </div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
                <div class="space-y-12">
                    <div class="space-y-4">
                        <span class="text-brand-accent font-black tracking-widest uppercase text-xs">Why Choose Us</span>
                        <h2 class="text-5xl font-black italic">DỊCH VỤ <br /> ĐẲNG CẤP 5 SAO</h2>
                    </div>

                    <div class="space-y-8">
                        <?php
                            $features = [
                                ['icon' => 'zap', 'title' => 'Tốc độ', 'desc' => 'Hệ thống vận hành tối ưu, đặt vé và xác nhận chỉ sau 30 giây.'],
                                ['icon' => 'shield-check', 'title' => 'An toàn', 'desc' => 'Đội ngũ lái xe kinh nghiệm vượt mức 10 năm, đào tạo bài bản.'],
                                ['icon' => 'coffee', 'title' => 'Tiện nghi', 'desc' => 'Nước uống, khăn lạnh, wifi tốc độ cao và sạc dự phòng tại mỗi ghế.']
                            ];
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <div class="flex gap-6 group">
                                <div
                                    class="w-16 h-16 rounded-2xl glass flex items-center justify-center group-hover:liquid-gradient transition-all duration-500 shrink-0">
                                    <i data-lucide="<?php echo e($f['icon']); ?>"
                                        class="w-8 h-8 group-hover:text-white transition-colors text-brand-accent"></i>
                                </div>
                                <div class="space-y-2">
                                    <h4 class="text-xl font-bold font-heading"><?php echo e($f['title']); ?></h4>
                                    <p class="text-white/50 text-sm leading-relaxed"><?php echo e($f['desc']); ?></p>
                                </div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>

                <div class="relative">
                    <div class="aspect-square rounded-4xl overflow-hidden glass p-4">
                        <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&q=80&w=800"
                            class="w-full h-full object-cover rounded-3xl" alt="Bus Interior">
                    </div>
                    <div class="absolute -bottom-10 -left-10 glass p-8 rounded-3xl shadow-2xl space-y-2 max-w-[200px]">
                        <p class="text-4xl font-black text-brand-accent italic">20+</p>
                        <p class="text-xs font-bold uppercase tracking-widest text-white/50 leading-tight">Năm kinh nghiệm
                            vận tải</p>
                    </div>
                    <div
                        class="absolute -top-10 -right-10 w-32 h-32 liquid-gradient rounded-full blur-[60px] opacity-30 animate-pulse">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- App CTA -->
    <section class="py-32 max-w-7xl mx-auto px-6 reveal">
        <div
            class="liquid-gradient rounded-4xl p-16 relative overflow-hidden flex flex-col items-center text-center space-y-8">
            <div class="absolute inset-0 bg-black/10"></div>
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-white/10 blur-[80px] rounded-full translate-x-1/2 -translate-y-1/2">
            </div>

            <div class="relative z-10 space-y-4">
                <h2 class="text-5xl font-black italic text-white uppercase tracking-tighter"><?php echo e(__('ready_to_launch')); ?>

                </h2>
                <p class="text-xl text-white/80 max-w-2xl mx-auto">
                    Tải ngay ứng dụng Nhà xe Mạnh Hùng để nhận ưu đãi 50.000đ cho chuyến đi đầu tiên.
                </p>
            </div>

            <div class="relative z-10 flex flex-wrap justify-center gap-6">
                <a href="#"
                    class="flex items-center gap-4 bg-black text-white px-8 py-4 rounded-2xl hover:bg-white hover:text-black transition-all">
                    <i data-lucide="smartphone" class="w-6 h-6"></i>
                    <div class="text-left">
                        <p class="text-[10px] font-bold uppercase opacity-50">Download on</p>
                        <p class="text-lg font-bold leading-tight">App Store</p>
                    </div>
                </a>
                <a href="#"
                    class="flex items-center gap-4 bg-black text-white px-8 py-4 rounded-2xl hover:bg-white hover:text-black transition-all">
                    <i data-lucide="play" class="w-6 h-6"></i>
                    <div class="text-left">
                        <p class="text-[10px] font-bold uppercase opacity-50">Get it on</p>
                        <p class="text-lg font-bold leading-tight">Google Play</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

<!-- Contact Section -->
<section id="contact" class="py-32 bg-brand-dark reveal">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-8"><?php echo e(__('contact')); ?></h2>
        <p class="text-white/60 max-w-2xl mx-auto mb-12">Liên hệ với chúng tôi để được hỗ trợ nhanh nhất</p>
        <div class="flex flex-wrap justify-center gap-8">
            <div class="glass-dark p-8 rounded-2xl">
                <i data-lucide="phone" class="w-8 h-8 text-brand-primary mb-4"></i>
                <h3 class="text-white font-bold mb-2">Hotline</h3>
                <p class="text-white/60">1900 1234</p>
            </div>
            <div class="glass-dark p-8 rounded-2xl">
                <i data-lucide="mail" class="w-8 h-8 text-brand-primary mb-4"></i>
                <h3 class="text-white font-bold mb-2">Email</h3>
                <p class="text-white/60">support@manhhung.com</p>
            </div>
            <div class="glass-dark p-8 rounded-2xl">
                <i data-lucide="map-pin" class="w-8 h-8 text-brand-primary mb-4"></i>
                <h3 class="text-white font-bold mb-2"><?php echo e(__('address')); ?></h3>
                <p class="text-white/60">123 Nguyễn Văn Linh, Q.7, TP.HCM</p>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\code\laragon\www\du-an-tot-nghiep\resources\views/customer/home/index.blade.php ENDPATH**/ ?>