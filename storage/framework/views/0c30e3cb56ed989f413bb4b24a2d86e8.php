<?php $__env->startSection('title', 'Quét mã QR'); ?>
<?php $__env->startSection('header-title', 'CHUYỂN KHOẢN'); ?>
<?php $__env->startSection('header-subtitle', 'Thanh toán qua mã QR Ngân hàng'); ?>

<?php $__env->startSection('content-main'); ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            
            <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 text-center">
                <h3 class="fw-black text-dark text-uppercase mb-1">Thanh toán chuyển khoản</h3>
                <p class="text-muted small mb-4">Vui lòng quét mã QR bên dưới bằng app ngân hàng</p>

                <div class="p-3 border rounded-4 bg-light mb-4 shadow-sm" style="border-color: #ffb347 !important;">
                    <img src="https://img.vietqr.io/image/970419-123456789-compact2.jpg?amount=<?php echo e($order->amount); ?>&addInfo=<?php echo e($order->order_code); ?>&accountName=CONG TY BAN VE" 
                         class="img-fluid rounded-3 w-100" alt="QR Code">
                </div>

                <div class="bg-light rounded-4 p-3 text-start mb-4 border">
                    <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                        <span class="text-muted fw-medium">Số tiền:</span>
                        <span class="text-dark fw-bold fs-5"><?php echo e(number_format($order->amount)); ?> VNĐ</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted fw-medium">Nội dung CK:</span>
                        <span class="fw-bold fs-5" style="color: #ff7a18;"><?php echo e($order->order_code); ?></span>
                    </div>
                </div>

                <form action="<?php echo e(route('checkout.bank_transfer.upload', $order->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-dark w-100 py-3 rounded-4 fw-bold fs-6 shadow-sm">
                        TÔI ĐÃ CHUYỂN KHOẢN XONG
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\checkout\bank_transfer.blade.php ENDPATH**/ ?>