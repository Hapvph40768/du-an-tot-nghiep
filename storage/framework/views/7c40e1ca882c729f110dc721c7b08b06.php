<?php $__env->startSection('content-main'); ?>

<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">Quản lý Hỗ trợ Khách hàng</h1>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Mã</th>
                            <th>Khách hàng</th>
                            <th>Loại</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Ngày gửi</th>
                            <th class="text-end pe-4">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr>
                            <td class="ps-4">#<?php echo e($ticket->id); ?></td>
                            <td>
                                <div class="fw-bold"><?php echo e($ticket->user->name ?? 'N/A'); ?></div>
                                <small class="text-muted"><?php echo e($ticket->user->phone ?? ''); ?></small>
                            </td>
                            <td>
                                <span class="badge bg-info-subtle text-info px-2">
                                    <?php echo e(ucfirst($ticket->type)); ?>

                                </span>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 200px;"><?php echo e($ticket->description); ?></div>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ticket->status == 'open'): ?>
                                    <span class="badge bg-danger rounded-pill">Chưa xử lý</span>
                                <?php elseif($ticket->status == 'processing'): ?>
                                    <span class="badge bg-warning text-dark rounded-pill">Đang phản hồi</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary rounded-pill">Đã đóng</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td><?php echo e($ticket->created_at->format('H:i d/m/Y')); ?></td>
                            <td class="text-end pe-4">
                                <a href="<?php echo e(route('admin.support_tickets.show', $ticket->id)); ?>" class="btn btn-sm btn-primary px-3">
                                    <i class='bx bx-message-detail'></i> Trả lời
                                </a>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">Không có yêu cầu hỗ trợ nào.</td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <?php echo e($tickets->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/support_tickets/index.blade.php ENDPATH**/ ?>