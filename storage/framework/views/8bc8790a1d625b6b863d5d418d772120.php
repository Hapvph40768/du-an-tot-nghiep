<?php $__env->startSection('content-main'); ?>

<div class="container py-4">

    <h3 class="mb-4">🎧 Hỗ trợ khách hàng</h3>

    <div class="row">

        
        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-header bg-primary text-white">
                    Tạo yêu cầu hỗ trợ
                </div>

                <div class="card-body">

                    <form method="POST" action="<?php echo e(route('customer.support.store')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Loại hỗ trợ</label>

                            <select name="type" class="form-select">
                                <option value="payment">Thanh toán</option>
                                <option value="ticket">Vé</option>
                                <option value="complaint">Khiếu nại</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>

                            <textarea 
                                name="description"
                                class="form-control"
                                rows="4"
                                placeholder="Mô tả vấn đề của bạn..."
                                required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Gửi yêu cầu
                        </button>

                    </form>

                </div>

            </div>

        </div>


        
        <div class="col-md-8">

            <div class="card shadow-sm">

                <div class="card-header bg-dark text-white">
                    Danh sách yêu cầu
                </div>

                <div class="card-body">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Loại</th>
                                <th>Trạng thái</th>
                                <th>Ngày</th>
                                <th></th>
                            </tr>

                        </thead>

                        <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>

                                <td>#<?php echo e($ticket->id); ?></td>

                                <td>

                                    <?php switch($ticket->type):

                                        case ('payment'): ?>
                                            <span class="badge bg-primary">Payment</span>
                                            <?php break; ?>

                                        <?php case ('ticket'): ?>
                                            <span class="badge bg-info">Ticket</span>
                                            <?php break; ?>

                                        <?php case ('complaint'): ?>
                                            <span class="badge bg-danger">Complaint</span>
                                            <?php break; ?>

                                    <?php endswitch; ?>

                                </td>

                                <td>

                                    <?php switch($ticket->status):

                                        case ('open'): ?>
                                            <span class="badge bg-danger">Open</span>
                                            <?php break; ?>

                                        <?php case ('processing'): ?>
                                            <span class="badge bg-warning text-dark">Processing</span>
                                            <?php break; ?>

                                        <?php case ('closed'): ?>
                                            <span class="badge bg-success">Closed</span>
                                            <?php break; ?>

                                    <?php endswitch; ?>

                                </td>

                                <td>
                                    <?php echo e(optional($ticket->created_at)->format('d/m/Y')); ?>

                                </td>

                                <td>

                                    <a href="<?php echo e(route('customer.support.show',$ticket->id)); ?>"
                                       class="btn btn-sm btn-dark">

                                        💬 Chat

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Chưa có ticket hỗ trợ
                                </td>
                            </tr>

                        <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.home', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/customer/support/index.blade.php ENDPATH**/ ?>