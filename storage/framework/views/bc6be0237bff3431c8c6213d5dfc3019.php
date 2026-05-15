<?php $__env->startSection('title', 'Danh sách Tài xế'); ?>
<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold m-0">Quản lý Tài xế</h4>
                <p class="text-muted small mb-0">Tổng: <?php echo e($drivers->total()); ?> tài xế</p>
            </div>
            <a href="<?php echo e(route('admin.drivers.create')); ?>" class="btn px-4 py-2 fw-bold text-white" style="background:#ff6b00; border-radius:10px;">
                <i class='bx bx-plus-circle'></i> Thêm tài xế
            </a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="alert alert-success border-0 rounded-3 small"><?php echo e(session('success')); ?></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light small text-uppercase text-muted">
                    <tr>
                        <th>Tài xế</th>
                        <th>Số điện thoại</th>
                        <th>CCCD</th>
                        <th>Số bằng lái</th>
                        <th>Hạng</th>
                        <th>Hết hạn BLX</th>
                        <th>Kinh nghiệm</th>
                        <th>Trạng thái</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($driver->avatar): ?>
                                    <img src="<?php echo e(Storage::url($driver->avatar)); ?>" class="rounded-circle" style="width:36px;height:36px;object-fit:cover;" alt="">
                                <?php else: ?>
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:36px;height:36px;">
                                        <i class='bx bxs-user text-muted'></i>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div>
                                    <div class="fw-bold small"><?php echo e($driver->name); ?></div>
                                    <div class="text-muted" style="font-size:11px;"><?php echo e($driver->user->email ?? '—'); ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="small"><?php echo e($driver->phone ?? '—'); ?></td>
                        <td class="small"><?php echo e($driver->id_card_number ?? '—'); ?></td>
                        <td class="small font-monospace"><?php echo e($driver->license_number ?? '—'); ?></td>
                        <td>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($driver->license_class): ?>
                                <span class="badge bg-primary bg-opacity-10 text-primary"><?php echo e($driver->license_class); ?></span>
                            <?php else: ?>
                                <span class="text-muted small">—</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td class="small">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($driver->license_expiry_date): ?>
                                <?php $expired = \Carbon\Carbon::parse($driver->license_expiry_date)->isPast(); ?>
                                <span class="<?php echo e($expired ? 'text-danger fw-bold' : 'text-dark'); ?>">
                                    <?php echo e(\Carbon\Carbon::parse($driver->license_expiry_date)->format('d/m/Y')); ?>

                                </span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expired): ?> <i class='bx bx-error text-danger' title="Đã hết hạn"></i> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td class="small"><?php echo e($driver->experience_years); ?> năm</td>
                        <td>
                            <span class="badge rounded-pill <?php echo e($driver->status === 'active' ? 'bg-success' : 'bg-secondary'); ?>">
                                <?php echo e($driver->status === 'active' ? 'Hoạt động' : 'Ngừng'); ?>

                            </span>
                        </td>
                        <td class="text-end">
                            <a href="<?php echo e(route('admin.drivers.show', $driver->id)); ?>" class="btn btn-sm btn-light border" title="Xem chi tiết"><i class='bx bx-show'></i></a>
                            <a href="<?php echo e(route('admin.drivers.edit', $driver->id)); ?>" class="btn btn-sm btn-light border text-primary" title="Sửa"><i class='bx bx-edit'></i></a>
                            <form action="<?php echo e(route('admin.drivers.destroy', $driver->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xóa tài xế này?')"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr><td colspan="9" class="text-center text-muted py-4">Chưa có tài xế nào.</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3"><?php echo e($drivers->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/drivers/index.blade.php ENDPATH**/ ?>