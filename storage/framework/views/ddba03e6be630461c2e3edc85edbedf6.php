<?php $__env->startSection('content'); ?>
<div class="mb-8">
    <h1 class="text-3xl font-bold">Hồ sơ Nhân viên</h1>
    <p class="text-gray-500 italic">Quản lý thông tin cá nhân và theo dõi hiệu suất làm việc.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
    <!-- CỘT TRÁI: THẺ ĐỊNH DANH & STATS -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white dark:bg-[#111111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626] text-center">
            <div class="relative w-32 h-32 mx-auto mb-4 group">
                <img src="<?php echo e($user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=3b82f6&color=fff&size=128'); ?>" 
                     class="w-full h-full rounded-full object-cover border-4 border-white dark:border-[#222] shadow-xl" alt="Avatar">
                <div class="absolute inset-0 bg-black/40 rounded-full opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16"><path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/><path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172l-.628-1.047A1 1 0 0 0 11.232 2H4.768a1 1 0 0 0-.868.453L3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/></svg>
                </div>
            </div>
            <h2 class="text-2xl font-black mb-1"><?php echo e($user->name); ?></h2>
            <div class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-black uppercase tracking-widest mb-4">
                <?php echo e(strtoupper($user->role)); ?> - <?php echo e($user->department ?? 'Văn phòng'); ?>

            </div>
            <div class="text-sm opacity-60 italic mb-6">ID: <?php echo e($user->employee_id ?? 'NV-'.str_pad($user->id, 4, '0', STR_PAD_LEFT)); ?></div>
            
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-[#e3e3e0] dark:border-[#262626] border-dashed">
                <div class="text-center">
                    <div class="text-lg font-black text-blue-600"><?php echo e($stats['check_ins']); ?></div>
                    <div class="text-[10px] opacity-40 font-bold uppercase">Check-in</div>
                </div>
                <div class="text-center">
                    <div class="text-lg font-black text-green-600"><?php echo e($stats['money_confirmed']); ?></div>
                    <div class="text-[10px] opacity-40 font-bold uppercase">Thu tiền</div>
                </div>
            </div>
        </div>

        <div class="bg-blue-600 rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
            <div class="relative z-10">
                <div class="text-xs font-bold uppercase opacity-60 mb-1">Ngày gia nhập</div>
                <div class="text-lg font-black mb-4"><?php echo e(\Carbon\Carbon::parse($user->joined_date ?? $user->created_at)->format('d/m/Y')); ?></div>
                
                <div class="text-xs font-bold uppercase opacity-60 mb-1">Loại hợp đồng</div>
                <div class="text-lg font-black"><?php echo e($user->contract_type ?? 'Chính thức'); ?></div>
            </div>
            <div class="absolute -right-4 -bottom-4 opacity-10">
                <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" viewBox="0 0 16 16"><path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/><path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/><path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/></svg>
            </div>
        </div>
    </div>

    <!-- CỘT PHẢI: FORM CHỈNH SỬA & SECURITY -->
    <div class="lg:col-span-2 space-y-8">
        <!-- TAB CHỌN -->
        <div class="bg-white dark:bg-[#111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <h3 class="text-xl font-black mb-6 flex items-center gap-2">
                <span class="w-1 h-5 bg-blue-600 rounded"></span> Cập nhật thông tin cá nhân
            </h3>
            
            <form action="<?php echo e(route('staff.profile.update')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase opacity-40 mb-2 italic">Họ và tên nhân viên</label>
                        <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-2xl font-bold focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase opacity-40 mb-2 italic">Số điện thoại liên hệ</label>
                        <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>" class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-2xl font-bold focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase opacity-40 mb-2 italic">Ngày sinh</label>
                        <input type="date" name="birthday" value="<?php echo e(old('birthday', $user->birthday)); ?>" class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-2xl font-bold focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase opacity-40 mb-2 italic">Giới tính</label>
                        <select name="gender" class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-2xl font-bold focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                            <option value="male" <?php echo e($user->gender == 'male' ? 'selected' : ''); ?>>Nam</option>
                            <option value="female" <?php echo e($user->gender == 'female' ? 'selected' : ''); ?>>Nữ</option>
                            <option value="other" <?php echo e($user->gender == 'other' ? 'selected' : ''); ?>>Khác</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase opacity-40 mb-2 italic">Địa chỉ thường trú</label>
                    <textarea name="address" rows="3" class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-2xl font-bold focus:ring-2 focus:ring-blue-500 outline-none transition-all"><?php echo e(old('address', $user->address)); ?></textarea>
                </div>

                <div class="pt-4 border-t border-gray-50 flex justify-end">
                    <button type="submit" class="px-8 py-4 bg-black text-white rounded-2xl font-black shadow-lg shadow-black/20 hover:scale-105 transition-all">Lưu thay đổi hồ sơ</button>
                </div>
            </form>
        </div>

        <!-- ĐỔI MẬT KHẨU -->
        <div class="bg-gray-50 dark:bg-[#0a0a0a] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <h3 class="text-xl font-black mb-6 flex items-center gap-2">
                <span class="w-1 h-5 bg-red-500 rounded"></span> Bảo mật tài khoản
            </h3>
            
            <form action="<?php echo e(route('staff.profile.password')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase opacity-40 mb-2 italic">Mật khẩu hiện tại</label>
                        <input type="password" name="current_password" class="w-full px-5 py-3 bg-white border border-gray-100 rounded-2xl font-bold focus:ring-2 focus:ring-red-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase opacity-40 mb-2 italic">Mật khẩu mới</label>
                        <input type="password" name="password" class="w-full px-5 py-3 bg-white border border-gray-100 rounded-2xl font-bold focus:ring-2 focus:ring-red-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase opacity-40 mb-2 italic">Xác nhận mật khẩu mới</label>
                        <input type="password" name="password_confirmation" class="w-full px-5 py-3 bg-white border border-gray-100 rounded-2xl font-bold focus:ring-2 focus:ring-red-500 outline-none transition-all">
                    </div>
                </div>
                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-red-600 text-white rounded-xl font-black shadow-lg shadow-red-500/20 hover:scale-105 transition-all">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- LỊCH SỬ HOẠT ĐỘNG (Activity Log) -->
<div class="bg-white dark:bg-[#111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626] mb-12">
    <h3 class="text-xl font-black mb-6 flex items-center gap-2">
        <span class="w-1 h-5 bg-gray-500 rounded"></span> Nhật ký hoạt động cá nhân
    </h3>
    <div class="relative border-l-2 border-gray-100 dark:border-gray-800 ml-3 space-y-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recentLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div class="relative pl-8">
                <span class="absolute -left-[9px] top-1.5 w-4 h-4 bg-white border-2 border-gray-200 dark:bg-black dark:border-gray-700 rounded-full"></span>
                <div class="text-[10px] font-bold opacity-40 uppercase mb-1"><?php echo e($log->created_at->diffForHumans()); ?> (<?php echo e($log->ip_address); ?>)</div>
                <div class="text-sm font-bold"><?php echo e($log->description); ?></div>
                <div class="text-[10px] italic opacity-40">Mã hành động: <?php echo e(strtoupper($log->action)); ?></div>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.staff', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\staff\profile\index.blade.php ENDPATH**/ ?>