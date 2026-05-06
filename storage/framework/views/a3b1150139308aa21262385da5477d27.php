<?php $__env->startSection('page-title', 'Thông tin cá nhân'); ?>

<?php $__env->startSection('content-main'); ?>
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-6">
            <a href="<?php echo e(route('driver.home')); ?>" class="inline-flex items-center gap-2 text-gray-500 hover:text-amber-600 transition-colors font-medium">
                <i class='bx bx-chevron-left text-2xl'></i>
                Quay lại Trang Chủ
            </a>
        </div>

        <div class="grid md:grid-cols-12 gap-8">

            <!-- Avatar & Thông tin cơ bản -->
            <div class="md:col-span-4">
                <div class="bg-white rounded-3xl shadow-sm p-8 text-center">
                    <div
                        class="w-32 h-32 mx-auto bg-amber-100 rounded-2xl flex items-center justify-center text-6xl border-4 border-white shadow-md">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </div>

                    <h2 class="mt-6 text-2xl font-bold text-gray-800"><?php echo e(Auth::user()->name); ?></h2>
                    <p class="text-amber-600 font-medium">Tài xế chính</p>

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <div class="flex justify-center gap-8 text-sm">
                            <div>
                                <p class="text-gray-400">Trạng thái</p>
                                <p class="font-medium flex items-center justify-center gap-2 mt-1">
                                    <span
                                        class="w-2.5 h-2.5 rounded-full animate-pulse 
                                        <?php echo e(Auth::user()->driver?->status === 'inactive' ? 'bg-amber-500' : 'bg-emerald-500'); ?>"></span>
                                    <?php echo e(match (Auth::user()->driver?->status ?? 'available') {
                                        'inactive' => 'Offline',
                                        default => 'Online',
                                    }); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin chi tiết -->
            <div class="md:col-span-8">
                <div class="bg-white rounded-3xl shadow-sm p-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Thông tin liên hệ -->
                        <div>
                            <h3 class="font-semibold text-lg mb-4 text-gray-700">Thông tin liên hệ</h3>
                            <div class="space-y-5">
                                <div>
                                    <p class="text-xs text-gray-500">Họ và tên</p>
                                    <p class="font-medium"><?php echo e(Auth::user()->name); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Số điện thoại</p>
                                    <p class="font-medium"><?php echo e(Auth::user()->driver?->phone ?? Auth::user()->phone); ?></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Email</p>
                                    <p class="font-medium"><?php echo e(Auth::user()->email); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Giấy tờ & Kinh nghiệm -->
                        <div>
                            <h3 class="font-semibold text-lg mb-4 text-gray-700">Giấy tờ & Kinh nghiệm</h3>
                            <div class="space-y-5">
                                <div>
                                    <p class="text-xs text-gray-500">Số bằng lái</p>
                                    <p class="font-medium"><?php echo e(Auth::user()->driver?->license_number ?? 'Chưa cập nhật'); ?>

                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Số năm kinh nghiệm</p>
                                    <p class="font-medium">
                                        <?php echo e(Auth::user()->driver?->experience_years ?? '0'); ?> năm
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Trạng thái</p>
                                    <p class="font-medium capitalize">
                                        <?php echo e(Auth::user()->driver?->status); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thông tin cá nhân -->
                    <div class="mt-10 pt-8 border-t border-gray-100">
                        <h3 class="font-semibold text-lg mb-4 text-gray-700">Thông tin thêm</h3>
                        <div class="bg-gray-50 rounded-2xl p-6 text-gray-700 leading-relaxed">
                            <?php echo e(Auth::user()->driver?->personal_info ?? 'Chưa có thông tin bổ sung.'); ?>

                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="mt-10 flex gap-4">
                        <a href="#"
                            class="flex-1 bg-amber-600 hover:bg-amber-700 text-white text-center py-4 rounded-2xl font-medium transition">
                            Đổi mật khẩu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.driver.DriverLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\driver\profile\profile.blade.php ENDPATH**/ ?>