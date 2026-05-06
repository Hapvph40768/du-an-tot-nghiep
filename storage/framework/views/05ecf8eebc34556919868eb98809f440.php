<?php $__env->startSection('content-main'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h3 class="fw-bold text-center mb-4">Bạn đang gặp vấn đề gì?</h3>
                    
                    <form action="<?php echo e(route('customer.support.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        
                        <label class="form-label fw-bold mb-3">Vui lòng chọn danh mục hỗ trợ:</label>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="type" id="type_payment" value="payment" required onclick="updateDesc('Thanh toán')">
                                <label class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex flex-column align-items-center" for="type_payment">
                                    <i class='bx bx-credit-card fs-1 mb-2'></i>
                                    <span>Thanh toán</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="type" id="type_ticket" value="ticket" onclick="updateDesc('Vé xe')">
                                <label class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex flex-column align-items-center" for="type_ticket">
                                    <i class='bx bx-barcode-reader fs-1 mb-2'></i>
                                    <span>Đổi/Hủy vé</span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <input type="radio" class="btn-check" name="type" id="type_complaint" value="complaint" onclick="updateDesc('Khiếu nại')">
                                <label class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex flex-column align-items-center" for="type_complaint">
                                    <i class='bx bx-angry fs-1 mb-2'></i>
                                    <span>Khiếu nại</span>
                                </label>
                            </div>
                        </div>

                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Chuyến đi liên quan (không bắt buộc):</label>
                            <select name="booking_id" class="form-select rounded-3">
                                <option value="">-- Chọn chuyến đi --</option>
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($bookings)): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($booking->id); ?>">Mã #<?php echo e($booking->id); ?> - <?php echo e($booking->trip->route->departure); ?> đi <?php echo e($booking->trip->route->destination); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </div>

                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Mô tả chi tiết vấn đề:</label>
                            <textarea name="description" id="description" class="form-control rounded-3" rows="5" placeholder="Hãy mô tả vấn đề của bạn tại đây..." required></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2 fw-bold">Gửi yêu cầu ngay</button>
                            <a href="<?php echo e(route('customer.support.index')); ?>" class="btn btn-light">Hủy bỏ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateDesc(type) {
        let desc = document.getElementById('description');
        if(type === 'Thanh toán') {
            desc.value = "Tôi gặp vấn đề khi thanh toán cho đơn hàng. Tiền đã bị trừ nhưng vé chưa xác nhận...";
        } else if(type === 'Vé xe') {
            desc.value = "Tôi muốn đổi ngày đi hoặc hủy vé cho chuyến xe sắp tới. Lý do là...";
        } else if(type === 'Khiếu nại') {
            desc.value = "Tôi không hài lòng về chất lượng phục vụ/thái độ nhân viên tại nhà xe...";
        }
        desc.focus();
    }
</script>

<style>
    .btn-check:checked + .btn-outline-primary {
        background-color: #0d6efd;
        color: white;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\customer\support\support.blade.php ENDPATH**/ ?>