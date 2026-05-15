<?php $__env->startSection('title', 'Tạo mật khẩu mới'); ?>
<?php $__env->startSection('auth_title', 'Tạo mật khẩu mới'); ?>
<?php $__env->startSection('auth_subtitle', 'Vui lòng nhập mật khẩu mới cho tài khoản của bạn.'); ?>

<?php $__env->startSection('content'); ?>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl flex items-start gap-2 text-sm font-medium mb-6">
            <i data-lucide="alert-circle" class="w-4 h-4 mt-0.5"></i>
            <ul class="list-disc pl-4 space-y-1">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <li><?php echo e($error); ?></li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </ul>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <form method="post" action="<?php echo e(route('password.update')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        
        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1 text-center">Mã xác nhận (6 số)</label>
            <div class="relative group max-w-xs mx-auto">
                <input type="text" name="code" maxlength="6" pattern="\d{6}" class="w-full bg-white/5 border border-white/10 rounded-xl py-4 text-center text-2xl tracking-[0.5em] text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all font-mono" placeholder="------" required autofocus>
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Email của bạn</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
                <input type="email" name="email" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white/50 cursor-not-allowed focus:outline-none" value="<?php echo e($email ?? old('email')); ?>" required readonly>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Mật khẩu mới</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                    <i data-lucide="lock" class="w-5 h-5"></i>
                </div>
                <input type="password" name="password" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="Ít nhất 6 ký tự" required>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Xác nhận mật khẩu</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <input type="password" name="password_confirmation" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="Nhập lại mật khẩu mới" required>
            </div>
        </div>

        <button type="submit" class="w-full liquid-gradient hover:scale-[1.02] active:scale-[0.98] transition-all py-3.5 rounded-xl text-white font-bold text-lg flex items-center justify-center gap-2 shadow-lg shadow-brand-primary/20 mt-4">
            Cập nhật mật khẩu
            <i data-lucide="check-circle" class="w-5 h-5"></i>
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.AuthLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/auth/reset-password.blade.php ENDPATH**/ ?>