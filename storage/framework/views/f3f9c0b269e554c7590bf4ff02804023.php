<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Quản lý Tuyến đường</h3>
            <a href="<?php echo e(route('admin.routes.create')); ?>" class="btn btn-primary px-4" style="background: #ff6b00; border:none; border-radius: 10px;">
                <i class='bx bx-plus-circle'></i> Thêm Tuyến mới
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle" style="table-layout: fixed;">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th style="width: 10%;">ID</th>
                        <th style="width: 35%;">Điểm đi -> Điểm đến</th>
                        <th style="width: 20%;">Khoảng cách</th>
                        <th style="width: 20%;">Thời gian dự kiến</th>
                        <th style="width: 15%; text-align: right;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr>
                        <td>#<?php echo e($route->id); ?></td>
                        <td>
                            <div class="fw-bold text-dark">
                                <?php echo e($route->departureLocation->name); ?> 
                                <i class='bx bx-right-arrow-alt text-primary'></i> 
                                <?php echo e($route->destinationLocation->name); ?>

                            </div>
                        </td>
                        <td><?php echo e($route->distance_km); ?> km</td>
                        <td><?php echo e($route->estimated_time); ?> giờ</td>
                        <td class="text-end">
                            <a href="<?php echo e(route('admin.routes.edit', $route->id)); ?>" class="btn btn-sm btn-light border"><i class='bx bx-edit'></i></a>
                            <form action="<?php echo e(route('admin.routes.destroy', $route->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-light border text-danger"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/routes/index.blade.php ENDPATH**/ ?>