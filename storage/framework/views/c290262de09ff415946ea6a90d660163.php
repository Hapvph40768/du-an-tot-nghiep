<header class="fixed top-0 inset-x-0 z-50 transition-all duration-300 border-b border-white/5" :class="{ 'bg-[#0a0a0a]/80 backdrop-blur-xl shadow-2xl shadow-black/50': scrolled, 'bg-transparent': !scrolled }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-4">
        <div class="flex items-center justify-between">
            
            <!-- Logo & Brand -->
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('customer.home')); ?>" class="relative group">
                    <div class="w-12 h-12 rounded-xl liquid-gradient flex items-center justify-center shadow-lg shadow-brand-primary/20 group-hover:scale-105 transition-transform">
                        <i data-lucide="bus" class="text-white w-6 h-6"></i>
                    </div>
                </a>
                <div class="hidden sm:block">
                    <a href="<?php echo e(route('customer.home')); ?>" class="text-xl font-black tracking-tight uppercase hover:text-brand-primary transition-colors block">Mạnh <span class="text-brand-accent">Hùng</span></a>
                    <p class="text-[10px] uppercase tracking-widest text-white/50">Trải nghiệm 5 sao</p>
                </div>
            </div>

            <!-- Main Navigation -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-medium">
                <a href="<?php echo e(url('/#search')); ?>" class="text-white/70 hover:text-white transition-colors relative group">
                    Đặt vé
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-primary transition-all group-hover:w-full"></span>
                </a>
                <a href="<?php echo e(url('/#routes')); ?>" class="text-white/70 hover:text-white transition-colors relative group">
                    Tuyến đường
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-primary transition-all group-hover:w-full"></span>
                </a>
                <a href="<?php echo e(url('/#features')); ?>" class="text-white/70 hover:text-white transition-colors relative group">
                    Dịch vụ
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-primary transition-all group-hover:w-full"></span>
                </a>
                <a href="<?php echo e(route('customer.parcels.create')); ?>" class="text-white/70 hover:text-white transition-colors relative group">
                    Ký gửi hàng
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-brand-primary transition-all group-hover:w-full"></span>
                </a>
            </nav>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                <!-- Hotline -->
                <div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 bg-white/5 text-sm font-bold">
                    <i data-lucide="phone-call" class="w-4 h-4 text-brand-primary"></i>
                    <span>1900 6868</span>
                </div>

                <div class="h-6 w-px bg-white/10 hidden md:block"></div>

                <!-- Auth / Profile -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                    <div class="flex items-center gap-2">
                        <a href="<?php echo e(route('login')); ?>" class="text-sm font-medium hover:text-white text-white/70 transition-colors px-4 py-2 hidden sm:block">Đăng nhập</a>
                        <a href="<?php echo e(route('register')); ?>" class="text-sm font-bold liquid-gradient text-white px-5 py-2.5 rounded-full shadow-lg shadow-brand-primary/20 hover:scale-105 transition-transform">Đăng ký</a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <div class="flex items-center gap-4">
                        <a href="<?php echo e(route('customer.bookings.index')); ?>" class="text-sm font-medium hover:text-white text-white/70 transition-colors hidden sm:block">Vé của tôi</a>
                        
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 focus:outline-none">
                                <div class="w-10 h-10 rounded-full border border-brand-primary/30 p-0.5">
                                    <div class="w-full h-full bg-brand-primary/20 rounded-full flex items-center justify-center text-brand-primary font-bold">
                                        <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                                    </div>
                                </div>
                            </button>

                            <!-- Dropdown -->
                            <div x-show="open" x-transition.opacity class="absolute right-0 mt-3 w-56 rounded-2xl border border-white/10 bg-[#141414] shadow-2xl overflow-hidden glass-auth" x-cloak>
                                <div class="px-4 py-3 border-b border-white/5">
                                    <p class="text-sm text-white font-semibold"><?php echo e(Auth::user()->name); ?></p>
                                    <p class="text-xs text-white/50 truncate"><?php echo e(Auth::user()->email); ?></p>
                                </div>
                                <div class="p-2 space-y-1">
                                    <a href="<?php echo e(route('customer.profile.edit')); ?>" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-white/70 hover:text-white hover:bg-white/5 transition-colors">
                                        <i data-lucide="user" class="w-4 h-4"></i> Thông tin cá nhân
                                    </a>
                                    <a href="<?php echo e(route('customer.bookings.index')); ?>" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-white/70 hover:text-white hover:bg-white/5 transition-colors sm:hidden">
                                        <i data-lucide="ticket" class="w-4 h-4"></i> Vé của tôi
                                    </a>
                                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="block">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="w-full text-left flex items-center gap-3 px-3 py-2 rounded-xl text-sm text-red-400 hover:bg-red-500/10 transition-colors">
                                            <i data-lucide="log-out" class="w-4 h-4"></i> Đăng xuất
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/layout/customer/blocks/header.blade.php ENDPATH**/ ?>