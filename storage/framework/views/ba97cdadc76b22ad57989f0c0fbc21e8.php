<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success rounded-3 shadow-sm"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Quản lý Ký gửi Hàng hoá</h3>
            <a href="<?php echo e(route('admin.parcels.create')); ?>" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">
                <i class='bx bx-plus-circle'></i> Thêm Đơn ký gửi
            </a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>ID</th>
                        <th>Người gửi</th>
                        <th>Người nhận</th>
                        <th>Tuyến đường</th>
                        <th>Khối lượng</th>
                        <th>Phí vận chuyển</th>
                        <th>Trạng thái</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $parcels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parcel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr>
                        <td>#<?php echo e($parcel->id); ?></td>
                        <td>
                            <div class="fw-bold"><?php echo e($parcel->sender_name); ?></div>
                            <small class="text-muted"><?php echo e($parcel->sender_phone); ?></small>
                        </td>
                        <td>
                            <div class="fw-bold"><?php echo e($parcel->receiver_name); ?></div>
                            <small class="text-muted"><?php echo e($parcel->receiver_phone); ?></small>
                        </td>
                        <td><?php echo e($parcel->route->departureLocation->name ?? '—'); ?> → <?php echo e($parcel->route->destinationLocation->name ?? '—'); ?></td>
                        <td><?php echo e($parcel->weight); ?> kg</td>
                        <td><?php echo e(number_format($parcel->price)); ?> ₫</td>
                        <td>
                            <?php
                                $statusMap = ['pending'=>['Chờ xử lý','warning'], 'shipping'=>['Đang vận chuyển','primary'], 'completed'=>['Hoàn thành','success'], 'cancelled'=>['Đã huỷ','danger']];
                                [$label, $color] = $statusMap[$parcel->status] ?? [$parcel->status, 'secondary'];
                            ?>
                            <span class="badge bg-<?php echo e($color); ?>"><?php echo e($label); ?></span>
                        </td>
                        <td class="text-end">
                            <a href="<?php echo e(route('admin.parcels.edit', $parcel->id)); ?>" class="btn btn-sm btn-light border"><i class='bx bx-edit'></i></a>
                            <form action="<?php echo e(route('admin.parcels.destroy', $parcel->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xoá đơn ký gửi này?')"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr><td colspan="8" class="text-center text-muted py-4">Chưa có đơn hàng ký gửi nào</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3"><?php echo e($parcels->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/parcels/index.blade.php ENDPATH**/ ?>