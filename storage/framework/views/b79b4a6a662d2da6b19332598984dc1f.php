<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success rounded-3 shadow-sm"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Quản lý Khuyến mãi</h3>
            <a href="<?php echo e(route('admin.promotions.create')); ?>" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">
                <i class='bx bx-plus-circle'></i> Thêm Khuyến mãi
            </a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>ID</th>
                        <th>Mã</th>
                        <th>Loại</th>
                        <th>Giá trị</th>
                        <th>Hiệu lực</th>
                        <th>Số lần dùng</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $promotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr>
                        <td>#<?php echo e($p->id); ?></td>
                        <td><span class="badge bg-warning text-dark fw-bold"><?php echo e($p->code); ?></span></td>
                        <td><?php echo e($p->type == 'percent' ? 'Phần trăm (%)' : 'Cố định (VNĐ)'); ?></td>
                        <td><?php echo e($p->type == 'percent' ? $p->value.'%' : number_format($p->value).' ₫'); ?></td>
                        <td>
                            <small><?php echo e($p->start_date ? \Carbon\Carbon::parse($p->start_date)->format('d/m/Y') : '—'); ?></small>
                            →
                            <small><?php echo e($p->end_date ? \Carbon\Carbon::parse($p->end_date)->format('d/m/Y') : '—'); ?></small>
                        </td>
                        <td><?php echo e($p->current_uses); ?> / <?php echo e($p->max_uses ?? '∞'); ?></td>
                        <td class="text-end">
                            <a href="<?php echo e(route('admin.promotions.edit', $p->id)); ?>" class="btn btn-sm btn-light border"><i class='bx bx-edit'></i></a>
                            <form action="<?php echo e(route('admin.promotions.destroy', $p->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xoá khuyến mãi này?')"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">Chưa có khuyến mãi nào</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3"><?php echo e($promotions->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\admin\promotions\index.blade.php ENDPATH**/ ?>