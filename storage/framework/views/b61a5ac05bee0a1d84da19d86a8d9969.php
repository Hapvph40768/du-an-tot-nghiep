<?php $__env->startSection('title', 'Đăng nhập'); ?>
<?php $__env->startSection('auth_title', 'Đăng Nhập'); ?>
<?php $__env->startSection('auth_subtitle', 'Chào mừng trở lại! Vui lòng đăng nhập để tiếp tục.'); ?>

<?php $__env->startSection('content'); ?>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl flex items-center gap-2 text-sm font-medium">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
        <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-xl flex items-center gap-2 text-sm font-medium">
            <i data-lucide="alert-circle" class="w-4 h-4"></i>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="bg-yellow-500/10 border border-yellow-500/50 text-yellow-400 px-4 py-3 rounded-xl text-sm font-medium">
            <ul class="list-disc pl-5 space-y-1">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <li><?php echo e($error); ?></li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </ul>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <form method="post" action="<?php echo e(route('login')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        
        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Email</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
                <input type="email" name="email" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="phamvana@gmail.com" value="<?php echo e(old('email')); ?>" required autofocus>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-white/70 ml-1">Mật khẩu</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/40 group-focus-within:text-brand-primary transition-colors">
                    <i data-lucide="lock" class="w-5 h-5"></i>
                </div>
                <input type="password" name="password" class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 text-white placeholder-white/20 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all" placeholder="••••••••" required>
            </div>
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2 cursor-pointer group">
                <div class="relative flex items-center justify-center w-5 h-5 border border-white/20 rounded bg-white/5 group-hover:border-brand-primary transition-colors">
                    <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> class="absolute opacity-0 w-full h-full cursor-pointer peer">
                    <i data-lucide="check" class="w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                </div>
                <span class="text-white/60 group-hover:text-white/90 transition-colors">Ghi nhớ đăng nhập</span>
            </label>
            <a href="<?php echo e(route('password.request')); ?>" class="text-brand-accent hover:text-white transition-colors font-medium">Quên mật khẩu?</a>
        </div>

        <button type="submit" class="w-full liquid-gradient hover:scale-[1.02] active:scale-[0.98] transition-all py-3.5 rounded-xl text-white font-bold text-lg flex items-center justify-center gap-2 shadow-lg shadow-brand-primary/20">
            Đăng nhập hệ thống
            <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </button>

        <div class="relative flex items-center py-2">
            <div class="flex-grow border-t border-white/10"></div>
            <span class="flex-shrink-0 mx-4 text-white/40 text-sm">Hoặc</span>
            <div class="flex-grow border-t border-white/10"></div>
        </div>

        <a href="<?php echo e(route('login.google')); ?>" class="w-full flex items-center justify-center gap-3 py-3.5 rounded-xl bg-white hover:bg-gray-100 transition-colors text-gray-900 font-semibold shadow-lg">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
            Đăng nhập bằng Google
        </a>

        <p class="text-center text-sm text-white/50 mt-8">
            Chưa có tài khoản? <a href="<?php echo e(route('register')); ?>" class="text-brand-primary hover:text-white font-semibold transition-colors">Đăng ký ngay</a>
        </p>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.AuthLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/auth/login.blade.php ENDPATH**/ ?>