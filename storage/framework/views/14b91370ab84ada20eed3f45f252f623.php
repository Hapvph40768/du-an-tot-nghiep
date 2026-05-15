<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Chi Tiết Ký Gửi #<?php echo e($parcel->id); ?></h6>
                    <a href="<?php echo e(route('admin.parcels.index')); ?>" class="btn btn-secondary btn-sm mb-0">Quay lại</a>
                </div>
                <div class="card-body px-4 pt-4 pb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Người Gửi</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Tên:</strong> <?php echo e($parcel->sender_name); ?></li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Số điện thoại:</strong> <?php echo e($parcel->sender_phone); ?></li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Địa chỉ:</strong> <?php echo e($parcel->sender_address); ?></li>
                            </ul>

                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Người Nhận</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Tên:</strong> <?php echo e($parcel->receiver_name); ?></li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Số điện thoại:</strong> <?php echo e($parcel->receiver_phone); ?></li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Địa chỉ:</strong> <?php echo e($parcel->receiver_address); ?></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Thông Tin Gói Hàng</h6>
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Tuyến đường:</strong> <?php echo e($parcel->route->departureLocation->name ?? '...'); ?> → <?php echo e($parcel->route->destinationLocation->name ?? '...'); ?></li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Chuyến xe:</strong> 
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($parcel->trip): ?>
                                        Chuyến <?php echo e(\Carbon\Carbon::parse($parcel->trip->departure_time)->format('H:i')); ?> - Ngày <?php echo e(\Carbon\Carbon::parse($parcel->trip->trip_date)->format('d/m/Y')); ?><br>
                                        <small class="text-muted">Xe: <?php echo e($parcel->trip->vehicle->license_plate ?? 'N/A'); ?> | Lái xe: <?php echo e($parcel->trip->driver->name ?? 'N/A'); ?> (<?php echo e($parcel->trip->driver->phone ?? ''); ?>)</small>
                                    <?php else: ?>
                                        <span class="text-muted fst-italic">Chưa phân công xe</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Khối lượng:</strong> <?php echo e($parcel->weight); ?> kg</li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Giá cước:</strong> <?php echo e(number_format($parcel->price)); ?> ₫</li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Mô tả:</strong> <?php echo e($parcel->description ?: 'Không có mô tả'); ?></li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Ngày tạo:</strong> <?php echo e($parcel->created_at->format('d/m/Y H:i')); ?></li>
                                <li class="list-group-item px-0 text-sm"><strong class="text-dark">Trạng thái:</strong> 
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($parcel->status == 'pending'): ?>
                                        <span class="badge bg-warning">Chờ xử lý</span>
                                    <?php elseif($parcel->status == 'shipping'): ?>
                                        <span class="badge bg-info">Đang giao</span>
                                    <?php elseif($parcel->status == 'completed'): ?>
                                        <span class="badge bg-success">Đã giao</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Đã hủy</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/parcels/show.blade.php ENDPATH**/ ?>