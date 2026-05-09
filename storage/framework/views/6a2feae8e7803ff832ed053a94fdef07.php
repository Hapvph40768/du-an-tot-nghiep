<?php $__env->startSection('content-main'); ?>
<section class="py-12 lg:py-20 relative min-h-[80vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
        
        <!-- Header -->
        <div class="mb-10 text-center md:text-left">
            <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight uppercase flex items-center justify-center md:justify-start gap-3">
                <i data-lucide="user" class="w-8 h-8 text-brand-primary"></i> Hồ sơ cá nhân
            </h2>
            <p class="text-white/50 mt-2">Quản lý thông tin bảo mật và lịch sử đặt vé của bạn.</p>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p class="text-sm font-medium"><?php echo e(session('success')); ?></p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl mb-6">
                <ul class="list-disc pl-5 text-sm space-y-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <li><?php echo e($error); ?></li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="grid lg:grid-cols-3 gap-8">
            
            <!-- CỘT TRÁI: Form Thông Tin Cá Nhân -->
            <div class="lg:col-span-1">
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-primary/10 rounded-full blur-[40px] pointer-events-none"></div>
                    
                    <form action="<?php echo e(route('customer.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="space-y-6">
                            
                            <!-- Avatar Preview (Optional) -->
                            <div class="flex justify-center mb-8">
                                <div class="relative group">
                                    <div class="w-24 h-24 rounded-full bg-black/30 border-2 border-white/10 flex items-center justify-center overflow-hidden group-hover:border-brand-primary transition-colors">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($user->avatar) && $user->avatar): ?>
                                            <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <span class="text-3xl font-bold text-white/30"><?php echo e(substr($user->name, 0, 1)); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <div class="absolute inset-0 bg-black/50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                        <i data-lucide="camera" class="w-6 h-6 text-white"></i>
                                    </div>
                                    <!-- Transparent file input layered over the avatar -->
                                    <input type="file" name="avatar" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" title="Thay đổi ảnh đại diện">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-white/70 ml-1" for="name">Họ và Tên <span class="text-red-400">*</span></label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                                        <i data-lucide="user" class="w-5 h-5"></i>
                                    </div>
                                    <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>" required
                                        class="w-full px-4 py-3 pl-11 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors placeholder-white/20">
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-white/70 ml-1" for="email">Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40">
                                        <i data-lucide="mail" class="w-5 h-5"></i>
                                    </div>
                                    <input type="email" id="email" value="<?php echo e($user->email); ?>" disabled
                                        class="w-full px-4 py-3 pl-11 bg-black/30 border border-white/5 rounded-xl text-white/40 cursor-not-allowed">
                                </div>
                                <p class="text-xs text-white/40 mt-1 ml-1"><i data-lucide="info" class="w-3 h-3 inline-block mb-0.5"></i> Dùng để đăng nhập, không thể đổi.</p>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-white/70 ml-1" for="phone">Số điện thoại</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                                        <i data-lucide="phone" class="w-5 h-5"></i>
                                    </div>
                                    <input type="text" id="phone" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>"
                                        class="w-full px-4 py-3 pl-11 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors placeholder-white/20">
                                </div>
                            </div>

                            <div class="pt-6 mt-6 border-t border-white/10">
                                <button type="submit" class="w-full liquid-gradient hover:scale-[1.02] transition-transform text-white font-bold py-3.5 px-6 rounded-xl shadow-lg shadow-brand-primary/20 flex items-center justify-center gap-2">
                                    Cập nhật thông tin <i data-lucide="save" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- CỘT PHẢI: Lịch sử đặt vé -->
            <div class="lg:col-span-2">
                <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden relative">
                    <div class="p-6 md:p-8 flex items-center justify-between border-b border-white/10 bg-black/20">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <i data-lucide="clock" class="w-5 h-5 text-brand-primary"></i> Giao dịch gần đây
                        </h2>
                        <a href="<?php echo e(route('customer.bookings.index')); ?>" class="text-brand-primary font-medium hover:text-white transition-colors text-sm flex items-center gap-1">
                            Xem tất cả <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <div class="p-0">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($bookings) && $bookings->isEmpty()): ?>
                            <div class="p-12 text-center text-white/50 flex flex-col items-center">
                                <i data-lucide="ticket" class="w-12 h-12 mb-4 opacity-50"></i>
                                <p class="mb-6">Bạn chưa có đơn đặt vé nào.</p>
                                <a href="<?php echo e(url('/#search')); ?>" class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 text-white font-bold py-2.5 px-6 rounded-xl transition-colors border border-white/10">
                                    Đặt vé ngay
                                </a>
                            </div>
                        <?php elseif(isset($bookings)): ?>
                            <div class="divide-y divide-white/5">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $bookings->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <a href="<?php echo e(route('customer.bookings.show', $booking->id)); ?>" class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-6 hover:bg-white/5 transition-colors group">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center flex-shrink-0 group-hover:border-brand-primary/50 group-hover:bg-brand-primary/10 transition-colors">
                                                <i data-lucide="bus" class="w-5 h-5 text-white/50 group-hover:text-brand-primary transition-colors"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-white text-lg mb-1 flex items-center gap-2">
                                                    <?php echo e($booking->trip->route->departureLocation->name ?? '...'); ?>

                                                    <i data-lucide="arrow-right" class="w-3 h-3 text-brand-primary"></i>
                                                    <?php echo e($booking->trip->route->destinationLocation->name ?? '...'); ?>

                                                </p>
                                                <p class="text-sm text-white/50 flex items-center gap-3">
                                                    <span><i data-lucide="hash" class="w-3 h-3 inline"></i> <?php echo e($booking->id); ?></span>
                                                    <span><i data-lucide="calendar" class="w-3 h-3 inline"></i> <?php echo e(\Carbon\Carbon::parse($booking->trip->trip_date)->format('d/m/Y')); ?></span>
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto mt-2 sm:mt-0">
                                            <div class="text-left sm:text-right">
                                                <p class="font-black text-white text-lg"><?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?>đ</p>
                                                
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status == 'pending'): ?>
                                                    <span class="text-xs font-bold text-amber-400 uppercase tracking-wider">Đang chờ</span>
                                                <?php elseif($booking->status == 'paid'): ?>
                                                    <span class="text-xs font-bold text-green-400 uppercase tracking-wider">Đã thanh toán</span>
                                                <?php elseif($booking->status == 'cancelled'): ?>
                                                    <span class="text-xs font-bold text-red-400 uppercase tracking-wider">Đã hủy</span>
                                                <?php else: ?>
                                                    <span class="text-xs font-bold text-white/50 uppercase tracking-wider"><?php echo e($booking->status); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <i data-lucide="chevron-right" class="w-5 h-5 text-white/30 group-hover:text-brand-primary transition-colors group-hover:translate-x-1"></i>
                                        </div>
                                    </a>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/customer/profile/edit.blade.php ENDPATH**/ ?>