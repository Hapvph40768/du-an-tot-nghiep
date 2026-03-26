<?php $__env->startSection('content-main'); ?>
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
        
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

        <div class="grid md:grid-cols-3 gap-8">
            
            <!-- CỘT TRÁI: Form Thông Tin Cá Nhân -->
            <div class="md:col-span-1">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Hồ sơ cá nhân</h2>
                
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <form action="<?php echo e(route('customer.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="name">Họ và Tên <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>" required
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors">
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                                <input type="email" id="email" value="<?php echo e($user->email); ?>" disabled
                                    class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg text-gray-500 cursor-not-allowed">
                                <p class="text-xs text-gray-400 mt-1">Email dùng để đăng nhập, không thể đổi.</p>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="phone">Số điện thoại</label>
                                <input type="text" id="phone" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors">
                            </div>

                            <!-- Avatar -->
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="avatar">Ảnh đại diện</label>
                                <input type="file" id="avatar" name="avatar" accept="image/*"
                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors text-sm">
                            </div>

                            <div class="pt-4 mt-4 border-t border-gray-100 flex justify-end">
                                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition-colors w-full">
                                    Cập nhật thông tin
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- CỘT PHẢI: Lịch sử đặt vé -->
            <div class="md:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Lịch sử đặt vé gần đây</h2>
                    <a href="<?php echo e(route('customer.bookings.index')); ?>" class="text-amber-600 font-medium hover:text-amber-700 hover:underline text-sm">
                        Xem tất cả &rarr;
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($bookings) && $bookings->isEmpty()): ?>
                        <div class="p-10 text-center text-gray-500">
                            <i class="fas fa-ticket-alt text-4xl text-gray-300 mb-3 block"></i>
                            <p class="mb-4 text-base">Bạn chưa có đơn đặt vé nào.</p>
                            <a href="<?php echo e(route('customer.home')); ?>" class="inline-block bg-amber-50 text-amber-600 hover:bg-amber-100 border border-amber-200 font-medium py-2 px-6 rounded-lg transition-colors">Đặt vé ngay</a>
                        </div>
                    <?php elseif(isset($bookings)): ?>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr class="bg-gray-50 uppercase text-xs font-semibold text-gray-500 border-b border-gray-100">
                                        <th class="p-4">Mã ĐH</th>
                                        <th class="p-4">Tuyến đường</th>
                                        <th class="p-4">Khởi hành</th>
                                        <th class="p-4 text-right">Tổng tiền</th>
                                        <th class="p-4 text-center">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $bookings->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?> 
                                        <tr class="hover:bg-amber-50 transition-colors cursor-pointer" onclick="window.location='<?php echo e(route('customer.bookings.show', $booking->id)); ?>'">
                                            <td class="p-4 font-bold text-gray-800">#<?php echo e($booking->id); ?></td>
                                            <td class="p-4 text-gray-700">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-medium truncate max-w-[120px]"><?php echo e($booking->trip->route->departureLocation->name ?? '...'); ?></span>
                                                    <i class="fas fa-arrow-right text-gray-400 text-xs"></i>
                                                    <span class="font-medium truncate max-w-[120px]"><?php echo e($booking->trip->route->destinationLocation->name ?? '...'); ?></span>
                                                </div>
                                            </td>
                                            <td class="p-4 text-gray-700">
                                                <div class="font-bold text-gray-800"><?php echo e(\Carbon\Carbon::parse($booking->trip->departure_time)->format('H:i')); ?></div>
                                                <div class="text-xs text-gray-500"><?php echo e(\Carbon\Carbon::parse($booking->trip->trip_date)->format('d/m/Y')); ?></div>
                                            </td>
                                            <td class="p-4 text-amber-600 font-bold text-right"><?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?>đ</td>
                                            <td class="p-4 text-center">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status == 'pending'): ?>
                                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded bg-opacity-70 text-xs font-bold inline-block border border-yellow-200">Đang chờ</span>
                                                <?php elseif($booking->status == 'paid'): ?>
                                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded bg-opacity-70 text-xs font-bold inline-block border border-green-200">Đã thanh toán</span>
                                                <?php elseif($booking->status == 'cancelled'): ?>
                                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded bg-opacity-70 text-xs font-bold inline-block border border-red-200">Đã hủy</span>
                                                <?php else: ?>
                                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded bg-opacity-70 text-xs font-bold inline-block border border-gray-200"><?php echo e(strtoupper($booking->status)); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/customer/profile/edit.blade.php ENDPATH**/ ?>