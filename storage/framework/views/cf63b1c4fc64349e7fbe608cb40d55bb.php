    <header class="gradient-hero bus-pattern text-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="<?php echo e(route('customer.home')); ?>"
                        class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center hover:bg-amber-600 transition-colors">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4 16c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4s-8 .5-8 4v10zm3.5 1c-.83 0-1.5-.67-1.5-1.5S6.67 14 7.5 14s1.5.67 1.5 1.5S8.33 17 7.5 17zm9 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm1.5-6H6V6h12v5z" />
                        </svg>
                    </a>
                    <div>
                        <a href="<?php echo e(route('customer.home')); ?>" id="brand-name"
                            class="text-xl font-bold hover:text-amber-300 transition-colors block">Mạnh Hùng</a>
                        <p id="slogan" class="text-xs text-amber-300">An toàn - Chất lượng - Đúng giờ</p>
                    </div>
                </div>

                <nav class="hidden md:flex items-center gap-6 text-sm">
                    <a href="<?php echo e(url('/#search')); ?>" class="hover:text-amber-300 transition-colors">Đặt vé</a>
                    <a href="<?php echo e(url('/#routes')); ?>" class="hover:text-amber-300 transition-colors">Tuyến đường</a>
                    <a href="<?php echo e(url('/#features')); ?>" class="hover:text-amber-300 transition-colors">Dịch vụ</a>
                    
                </nav>

                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-2 bg-white/10 px-3 py-2 rounded-lg">
                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        </svg>
                        <span id="hotline" class="font-semibold text-amber-300">1900 6868</span>
                    </div>

                    <!-- Logout -->
                    <div class="flex items-center gap-3">
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                            <div class="flex items-center gap-2">
                                <a href="<?php echo e(route('login')); ?>"
                                    class="text-sm font-medium hover:text-amber-300 transition-colors px-3 py-2">
                                    Đăng nhập
                                </a>
                                <a href="<?php echo e(route('register')); ?>"
                                    class="text-sm font-bold bg-amber-500 hover:bg-amber-600 text-white px-5 py-2 rounded-lg shadow-lg shadow-amber-900/20 transition-all transform hover:-translate-y-0.5">
                                    Đăng ký
                                </a>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            <div class="flex items-center gap-4">
                                <a href="<?php echo e(route('customer.bookings.index')); ?>"
                                    class="text-sm font-medium hover:text-amber-300 transition-colors px-3 py-2">
                                    Vé của tôi
                                </a>
                                <a href="<?php echo e(route('customer.profile.edit')); ?>"
                                    class="hidden lg:block text-sm font-medium text-amber-100 hover:text-white transition-colors">
                                    Chào, <?php echo e(Auth::user()->name); ?>

                                </a>

                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                        class="flex items-center gap-2 text-sm font-bold bg-white/10 hover:bg-red-500/20 text-white px-4 py-2 rounded-lg border border-white/20 transition-all">
                                        <i class='bx bx-log-out text-lg'></i>
                                        <span>Đăng xuất</span>
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/layout/customer/blocks/header.blade.php ENDPATH**/ ?>