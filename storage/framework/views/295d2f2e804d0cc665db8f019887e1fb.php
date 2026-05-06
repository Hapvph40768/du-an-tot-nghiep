<?php $__env->startSection('content-main'); ?>
<section class="py-12 bg-gray-50 border-t min-h-screen">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6 text-center">Xác nhận thanh toán</h2>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"><?php echo e(session('success')); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo e(session('error')); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold border-b pb-3 mb-4">Thông tin đơn hàng #<?php echo e($booking->id); ?></h3>
            <div class="space-y-3 text-gray-700">
                <div class="flex justify-between"><span>Khách hàng:</span> <span class="font-medium"><?php echo e($booking->contact_name); ?></span></div>
                <div class="flex justify-between"><span>Số điện thoại:</span> <span class="font-medium"><?php echo e($booking->contact_phone); ?></span></div>
                <div class="flex justify-between items-center mt-4">
                    <span>Tổng tiền vé:</span> 
                    <span class="text-2xl font-bold text-amber-600"><?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?> đ</span>
                </div>
            </div>
            <div class="mt-4 p-3 bg-red-50 text-red-700 text-sm rounded border border-red-100">
                <p><strong>Lưu ý:</strong> Vui lòng hoàn tất thanh toán trong vòng 15 phút để đảm bảo giữ chỗ.</p>
            </div>
        </div>

        <form action="<?php echo e(route('customer.payment.process', $booking->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="text-lg font-bold border-b pb-3 mb-4">Phương thức thanh toán</h3>
                <div class="space-y-4">
                    <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="radio" name="payment_method" value="vnpay" required class="text-amber-500 focus:ring-amber-500 w-5 h-5">
                        <span class="font-medium text-gray-800">Thanh toán bằng thẻ VNPay</span>
                    </label>
                    <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="radio" name="payment_method" value="momo" required class="text-amber-500 focus:ring-amber-500 w-5 h-5">
                        <span class="font-medium text-gray-800">Thanh toán qua Ví điện tử MoMo</span>
                    </label>
                    <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="radio" name="payment_method" value="cash" required class="text-amber-500 focus:ring-amber-500 w-5 h-5">
                        <span class="font-medium text-gray-800">Thanh toán tiền mặt (Tại văn phòng / Nhà xe)</span>
                    </label>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-4 px-6 rounded-xl transition-colors text-lg shadow-md">
                Xác nhận thanh toán
            </button>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\customer\payment\checkout.blade.php ENDPATH**/ ?>