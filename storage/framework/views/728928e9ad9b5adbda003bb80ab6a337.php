<?php $__env->startSection('title', 'Đăng ký tài khoản'); ?>
<?php $__env->startSection('auth_title', 'Bắt đầu hành trình'); ?>
<?php $__env->startSection('auth_subtitle', 'Gia nhập cộng đồng Mạnh Hùng ngay hôm nay'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-amber-400 text-sm animate-in fade-in slide-in-from-top-4 duration-500">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="help-circle" class="w-5 h-5 shrink-0"></i>
                    <p class="font-bold">Lỗi đăng ký:</p>
                </div>
                <ul class="space-y-1 ml-8 list-disc text-xs">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <li><?php echo e($error); ?></li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form method="post" action="<?php echo e(route('register')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-white/40 uppercase tracking-[0.2em] ml-1">Họ và tên</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none group-focus-within:text-brand-accent text-white/20 transition-colors">
                            <i data-lucide="user" class="w-4 h-4"></i>
                        </div>
                        <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                               class="w-full bg-white/[0.03] border border-white/10 rounded-2xl pl-12 pr-5 py-3.5 text-sm text-white focus:outline-none focus:border-brand-accent focus:bg-white/[0.05] transition-all"
                               placeholder="Nguyễn Văn A">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-white/40 uppercase tracking-[0.2em] ml-1">Số điện thoại</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none group-focus-within:text-brand-accent text-white/20 transition-colors">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                        </div>
                        <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" required
                               class="w-full bg-white/[0.03] border border-white/10 rounded-2xl pl-12 pr-5 py-3.5 text-sm text-white focus:outline-none focus:border-brand-accent focus:bg-white/[0.05] transition-all"
                               placeholder="09xx xxx xxx">
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-bold text-white/40 uppercase tracking-[0.2em] ml-1">Địa chỉ Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none group-focus-within:text-brand-accent text-white/20 transition-colors">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </div>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                           class="w-full bg-white/[0.03] border border-white/10 rounded-2xl pl-12 pr-5 py-3.5 text-sm text-white focus:outline-none focus:border-brand-accent focus:bg-white/[0.05] transition-all"
                           placeholder="yourname@gmail.com">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-white/40 uppercase tracking-[0.2em] ml-1">Mật khẩu</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none group-focus-within:text-brand-accent text-white/20 transition-colors">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </div>
                        <input type="password" name="password" required
                               class="w-full bg-white/[0.03] border border-white/10 rounded-2xl pl-12 pr-5 py-3.5 text-sm text-white focus:outline-none focus:border-brand-accent focus:bg-white/[0.05] transition-all"
                               placeholder="••••••••">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-white/40 uppercase tracking-[0.2em] ml-1">Xác nhận</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none group-focus-within:text-brand-accent text-white/20 transition-colors">
                            <i data-lucide="check-shield" class="w-4 h-4"></i>
                        </div>
                        <input type="password" name="password_confirmation" required
                               class="w-full bg-white/[0.03] border border-white/10 rounded-2xl pl-12 pr-5 py-3.5 text-sm text-white focus:outline-none focus:border-brand-accent focus:bg-white/[0.05] transition-all"
                               placeholder="••••••••">
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-bold text-white/40 uppercase tracking-[0.2em] ml-1">Vai trò thành viên</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none group-focus-within:text-brand-accent text-white/20 transition-colors">
                        <i data-lucide="briefcase" class="w-4 h-4"></i>
                    </div>
                    <select name="role" required
                            class="w-full bg-white/[0.03] border border-white/10 rounded-2xl pl-12 pr-5 py-3.5 text-sm text-white focus:outline-none focus:border-brand-accent focus:bg-white/[0.05] transition-all appearance-none cursor-pointer">
                        <option value="customer" <?php echo e(old('role') == 'customer' ? 'selected' : ''); ?> class="bg-[#1a1a1a]">Khách hàng</option>
                        <option value="driver" <?php echo e(old('role') == 'driver' ? 'selected' : ''); ?> class="bg-[#1a1a1a]">Đối tác tài xế</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-white/20">
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </div>
                </div>
            </div>

            <button type="submit" 
                    class="w-full py-4 rounded-2xl liquid-gradient font-black text-base shadow-xl shadow-brand-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3 group mt-4">
                <span>TẠO TÀI KHOẢN NGAY</span>
                <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
            </button>
        </form>

        <div class="pt-6 text-center border-t border-white/5">
            <p class="text-white/40 font-medium text-sm">
                Đã có tài khoản? 
                <a href="<?php echo e(route('login')); ?>" class="text-brand-accent font-black hover:underline ml-2 uppercase tracking-tighter">Đăng nhập</a>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.AuthLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\code\laragon\www\du-an-tot-nghiep\resources\views/auth/register.blade.php ENDPATH**/ ?>