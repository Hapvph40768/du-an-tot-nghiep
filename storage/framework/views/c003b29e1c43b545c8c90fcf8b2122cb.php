<?php $__env->startSection('content-main'); ?>
<section class="py-12 lg:py-20 relative min-h-[80vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-black text-white tracking-tight uppercase flex items-center gap-3">
                <i data-lucide="package-plus" class="w-8 h-8 text-brand-primary"></i> Tạo Đơn Ký Gửi
            </h2>
            <a href="<?php echo e(route('customer.parcels.index')); ?>" class="px-4 py-2 bg-white/10 text-white border border-white/20 rounded-xl font-medium text-sm hover:bg-white/20 transition-colors flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay lại
            </a>
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

        <form action="<?php echo e(route('customer.parcels.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <!-- Thông tin Người gửi & Người nhận -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                <!-- Người gửi -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 relative overflow-hidden group hover:border-brand-primary/30 transition-colors">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-primary/10 rounded-full blur-[40px] pointer-events-none group-hover:bg-brand-primary/20 transition-colors"></div>
                    
                    <h3 class="font-bold text-lg text-white mb-6 border-b border-white/10 pb-3 flex items-center gap-2">
                        <i data-lucide="user" class="w-5 h-5 text-brand-primary"></i> Người gửi
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-white/70 mb-2">Họ tên người gửi <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40">
                                    <i data-lucide="user" class="w-4 h-4"></i>
                                </div>
                                <input type="text" name="sender_name" value="<?php echo e(old('sender_name', Auth::user()->name ?? '')); ?>" required 
                                    class="w-full px-4 py-3 pl-11 bg-black/30 border border-white/10 rounded-xl text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white/70 mb-2">Số điện thoại <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40">
                                    <i data-lucide="phone" class="w-4 h-4"></i>
                                </div>
                                <input type="tel" name="sender_phone" value="<?php echo e(old('sender_phone', Auth::user()->phone ?? '')); ?>" required 
                                    class="w-full px-4 py-3 pl-11 bg-black/30 border border-white/10 rounded-xl text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Người nhận -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 relative overflow-hidden group hover:border-brand-accent/30 transition-colors">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-accent/10 rounded-full blur-[40px] pointer-events-none group-hover:bg-brand-accent/20 transition-colors"></div>
                    
                    <h3 class="font-bold text-lg text-white mb-6 border-b border-white/10 pb-3 flex items-center gap-2">
                        <i data-lucide="user-check" class="w-5 h-5 text-brand-accent"></i> Người nhận
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-white/70 mb-2">Họ tên người nhận <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40">
                                    <i data-lucide="user" class="w-4 h-4"></i>
                                </div>
                                <input type="text" name="receiver_name" value="<?php echo e(old('receiver_name')); ?>" required 
                                    class="w-full px-4 py-3 pl-11 bg-black/30 border border-white/10 rounded-xl text-white focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-colors">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white/70 mb-2">Số điện thoại <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40">
                                    <i data-lucide="phone" class="w-4 h-4"></i>
                                </div>
                                <input type="tel" name="receiver_phone" value="<?php echo e(old('receiver_phone')); ?>" required 
                                    class="w-full px-4 py-3 pl-11 bg-black/30 border border-white/10 rounded-xl text-white focus:outline-none focus:border-brand-accent focus:ring-1 focus:ring-brand-accent transition-colors">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Thông tin Hàng hóa -->
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 mb-8 relative overflow-hidden">
                <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-64 h-32 bg-brand-primary/5 blur-[50px] pointer-events-none"></div>

                <h3 class="font-bold text-lg text-white mb-6 border-b border-white/10 pb-3 flex items-center gap-2">
                    <i data-lucide="box" class="w-5 h-5 text-white/70"></i> Thông tin hàng hóa
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-2">Tuyến đường gửi <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40">
                                <i data-lucide="map" class="w-4 h-4"></i>
                            </div>
                            <select name="route_id" required class="w-full px-4 py-3 pl-11 bg-black/30 border border-white/10 rounded-xl text-white appearance-none focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors">
                                <option value="" class="bg-gray-900 text-white/50">-- Chọn tuyến đường --</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($route->id); ?>" <?php echo e(old('route_id') == $route->id ? 'selected' : ''); ?> class="bg-gray-900 text-white">
                                        <?php echo e($route->departureLocation->name ?? '...'); ?> &rarr; <?php echo e($route->destinationLocation->name ?? '...'); ?>

                                    </option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-white/40">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white/70 mb-2">Cân nặng (kg) <span class="text-red-400">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40">
                                <i data-lucide="scale" class="w-4 h-4"></i>
                            </div>
                            <input type="number" step="0.1" name="weight" value="<?php echo e(old('weight')); ?>" required min="0.1"
                                class="w-full px-4 py-3 pl-11 bg-black/30 border border-white/10 rounded-xl text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors">
                        </div>
                        <p class="text-xs text-brand-accent mt-2 flex items-center gap-1">
                            <i data-lucide="info" class="w-3 h-3"></i> Cước phí ước tính: ~10.000đ/kg (Tối thiểu 20.000đ)
                        </p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/70 mb-2">Mô tả hàng hóa <span class="text-white/40 font-normal">(Loại hàng, số lượng, lưu ý...)</span></label>
                    <textarea name="description" rows="3" placeholder="Ví dụ: 1 thùng quần áo, 2 tài liệu quan trọng cần nhẹ tay..." 
                        class="w-full px-4 py-3 bg-black/30 border border-white/10 rounded-xl text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors resize-y placeholder-white/20"><?php echo e(old('description')); ?></textarea>
                </div>
            </div>

            <!-- Actions -->
            <div class="text-center pt-4">
                <button type="submit" class="w-full sm:w-auto liquid-gradient hover:scale-[1.02] active:scale-[0.98] transition-transform text-white font-bold py-4 px-10 rounded-xl shadow-[0_10px_40px_-10px_rgba(255,91,36,0.6)] text-lg inline-flex items-center justify-center gap-3">
                    <i data-lucide="send" class="w-5 h-5"></i> Tạo đơn ký gửi ngay
                </button>
                <div class="mt-6 flex items-center justify-center gap-2 text-sm text-white/40 bg-black/20 py-3 px-4 rounded-xl border border-white/5 max-w-lg mx-auto">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-brand-primary flex-shrink-0"></i>
                    <p>Sau khi tạo, vui lòng mang hàng hóa ra văn phòng để nhân viên kiểm tra và thanh toán báo giá chính thức.</p>
                </div>
            </div>
            
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/customer/parcels/create.blade.php ENDPATH**/ ?>