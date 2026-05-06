<?php $__env->startSection('content-main'); ?>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Yêu cầu hỗ trợ của tôi</h2>
        <a href="<?php echo e(route('customer.support.create')); ?>" class="btn btn-primary px-4 rounded-pill">
            <i class='bx bx-plus'></i> Tạo yêu cầu mới
        </a>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted">
                    <tr>
                        <th class="ps-4">Mã</th>
                        <th>Loại hỗ trợ</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th class="text-end pe-4">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?> 
                    <tr>
                        <td class="ps-4 text-muted">#<?php echo e($ticket->id); ?></td>
                        <td>
                            <span class="badge bg-primary-subtle text-primary px-2">
                                <?php echo e($ticket->type ?? 'Hỗ trợ'); ?>

                            </span>
                        </td>
                        <td><div class="text-truncate" style="max-width: 250px;"><?php echo e($ticket->description); ?></div></td>
                        <td>
                            <span class="badge rounded-pill <?php echo e($ticket->status == 'open' ? 'bg-success' : 'bg-secondary'); ?>">
                                <?php echo e($ticket->status == 'open' ? 'Đang mở' : 'Đã đóng'); ?>

                            </span>
                        </td>
                        <td><?php echo e($ticket->created_at->format('d/m/Y')); ?></td>
                        <td class="text-end pe-4">
                            <button onclick="Livewire.dispatch('selectTicket', { id: <?php echo e($ticket->id); ?> })" class="btn btn-sm btn-light border">
                                <i class='bx bx-chat'></i> Chat AI
                            </button>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Bạn chưa có yêu cầu nào.</td>
                    </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.customer.CustomerLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\customer\support\index.blade.php ENDPATH**/ ?>