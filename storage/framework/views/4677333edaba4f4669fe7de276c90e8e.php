
<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success rounded-3 shadow-sm"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Quy tắc Điều chỉnh Giá vé</h3>
            <a href="<?php echo e(route('admin.price_rules.create')); ?>" class="btn btn-primary px-4" style="background:#ff6b00;border:none;border-radius:10px;">
                <i class='bx bx-plus-circle'></i> Thêm Quy tắc
            </a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted small text-uppercase">
                        <th>ID</th>
                        <th><?php echo e(__('name')); ?> quy tắc</th>
                        <th>Loại</th>
                        <th>Giá trị</th>
                        <th>Áp dụng từ</th>
                        <th>Đến ngày</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $priceRules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr>
                        <td>#<?php echo e($rule->id); ?></td>
                        <td class="fw-bold"><?php echo e($rule->name); ?></td>
                        <td><?php echo e($rule->type == 'percentage' ? 'Phần trăm (%)' : 'Cố định (VNĐ)'); ?></td>
                        <td>
                            <span class="badge bg-info text-dark">
                                +<?php echo e($rule->type == 'percentage' ? $rule->value.'%' : number_format($rule->value).' ₫'); ?></span>
                        </td>
                        <td><?php echo e($rule->start_date ? \Carbon\Carbon::parse($rule->start_date)->format('d/m/Y') : '—'); ?></td>
                        <td><?php echo e($rule->end_date ? \Carbon\Carbon::parse($rule->end_date)->format('d/m/Y') : '—'); ?></td>
                        <td class="text-end">
                            <a href="<?php echo e(route('admin.price_rules.edit', $rule->id)); ?>" class="btn btn-sm btn-light border"><i class='bx bx-edit'></i></a>
                            <form action="<?php echo e(route('admin.price_rules.destroy', $rule->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xoá quy tắc này?')"><i class='bx bx-trash'></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">Chưa có quy tắc giá nào</td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3"><?php echo e($priceRules->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/admin/price_rules/index.blade.php ENDPATH**/ ?>