<?php $__env->startSection('content-main'); ?>
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Tạo Đơn Ký gửi hàng hóa</h2>
            <a href="<?php echo e(route('customer.parcels.index')); ?>" class="text-amber-600 hover:text-amber-800 font-medium">
                &larr; Quay lại
            </a>
        </div>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm"><?php echo e(session('success')); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                <ul class="list-disc pl-5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <li><?php echo e($error); ?></li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white rounded-xl shadow-sm p-8">
            <form action="<?php echo e(route('customer.parcels.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Sender Info -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Người gửi</h3>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Họ tên người gửi <span class="text-red-500">*</span></label>
                            <input type="text" name="sender_name" value="<?php echo e(old('sender_name', Auth::user()->name ?? '')); ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại <span class="text-red-500">*</span></label>
                            <input type="text" name="sender_phone" value="<?php echo e(old('sender_phone', Auth::user()->phone ?? '')); ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500">
                        </div>
                    </div>

                    <!-- Receiver Info -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Người nhận</h3>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Họ tên người nhận <span class="text-red-500">*</span></label>
                            <input type="text" name="receiver_name" value="<?php echo e(old('receiver_name')); ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại <span class="text-red-500">*</span></label>
                            <input type="text" name="receiver_phone" value="<?php echo e(old('receiver_phone')); ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500">
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Thông tin hàng hóa</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tuyến đường gửi <span class="text-red-500">*</span></label>
                            <select name="route_id" required class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500">
                                <option value="">-- Chọn tuyến đường --</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($route->id); ?>" <?php echo e(old('route_id') == $route->id ? 'selected' : ''); ?>>
                                        <?php echo e($route->departureLocation->name ?? '...'); ?> &rarr; <?php echo e($route->destinationLocation->name ?? '...'); ?>

                                    </option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cân nặng (kg) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.1" name="weight" value="<?php echo e(old('weight')); ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500">
                            <p class="text-xs text-gray-500 mt-1">Cước phí ước tính: ~10.000đ/kg (Tối thiểu 20.000đ)</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả hàng hóa</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500" placeholder="Loại hàng hóa: quần áo, tài liệu, thực phẩm..."><?php echo e(old('description')); ?></textarea>
                    </div>
                </div>

                <div class="text-center pt-4 border-t">
                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-colors text-lg inline-flex items-center">
                        <i class="fas fa-paper-plane mr-2"></i> Tạo đơn ký gửi
                    </button>
                    <p class="text-sm text-gray-500 mt-3">Sau khi tạo, vui lòng mang hàng hóa ra văn phòng để nhân viên kiểm tra và thanh toán báo giá chính thức.</p>
                </div>
            </form>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/customer/parcels/create.blade.php ENDPATH**/ ?>