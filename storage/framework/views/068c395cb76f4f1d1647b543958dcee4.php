
<?php $__env->startSection('title', 'Danh mục Điểm trả'); ?>
<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark m-0">Danh mục Điểm trả gốc</h2>
            <p class="text-muted small mb-0">Quản lý bến xe, văn phòng dùng chung cho toàn hệ thống</p>
        </div>
        <a href="<?php echo e(route('admin.dropoff-points.create')); ?>" class="btn btn-primary px-4 py-2" style="background: #ff6b00; border:none; border-radius: 10px;">
            <i class='bx bx-plus-circle'></i> Thêm điểm trả vào kho
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tỉnh/Thành phố</th>
                        <th>Tên điểm trả</th>
                        <th>Địa chỉ</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $dropoffPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr>
                        <td><span class="badge bg-light text-primary border"><?php echo e($point->location->name); ?></span></td>
                        <td class="fw-bold"><?php echo e($point->name); ?></td>
                        <td class="text-muted small"><?php echo e($point->address); ?></td>
                        <td class="text-end">
                            <a href="<?php echo e(route('admin.dropoff-points.edit', $point->id)); ?>" class="btn btn-sm btn-light border text-primary"><i class='bx bx-edit'></i></a>
                            <form action="<?php echo e(route('admin.dropoff-points.destroy', $point->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xóa điểm này khỏi hệ thống?')"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($dropoffPoints->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/dropoff_points/index.blade.php ENDPATH**/ ?>