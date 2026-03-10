<?php $__env->startSection('content-main'); ?>
    <div class="container-fluid">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <h3 class="mb-3 mb-md-0 fw-semibold text-dark">
                <i class="bx bx-support me-2 text-primary"></i>
                Quản lý Support Tickets
            </h3>

            <div class="input-group" style="max-width: 400px;">
                <input type="text" id="searchInput" class="form-control border-end-0" placeholder="Tìm theo tên user hoặc nội dung tin..." aria-label="Search">
                <span class="input-group-text bg-white border-start-0">
                    <i class="bx bx-search text-muted"></i>
                </span>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="ticketsTable">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>User</th>
                                <th>Loại</th>
                                <th>Trạng thái</th>
                                <th>Tin nhắn mới nhất</th>
                                <th>Ngày tạo</th>
                                <th class="text-end pe-4">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="ps-4 fw-medium">#<?php echo e($ticket->id); ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm bg-primary-soft text-primary rounded-circle me-3 d-flex align-items-center justify-content-center">
                                                <?php echo e(strtoupper(substr($ticket->user?->name ?? 'N/A', 0, 1))); ?>

                                            </div>
                                            <div>
                                                <div class="fw-semibold"><?php echo e($ticket->user?->name ?? 'Khách'); ?></div>
                                                <small class="text-muted"><?php echo e($ticket->user?->email ?? '-'); ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary">
                                            <?php echo e($ticket->type ?? 'Khác'); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php switch($ticket->status):
                                            case ('open'): ?>
                                                <span class="badge bg-danger-subtle text-danger px-3 py-2">
                                                    <i class="bx bx-time me-1"></i> Open
                                                </span>
                                            <?php break; ?>
                                            <?php case ('processing'): ?>
                                                <span class="badge bg-warning-subtle text-warning px-3 py-2">
                                                    <i class="bx bx-cog me-1"></i> Processing
                                                </span>
                                            <?php break; ?>
                                            <?php case ('closed'): ?>
                                                <span class="badge bg-success-subtle text-success px-3 py-2">
                                                    <i class="bx bx-check-circle me-1"></i> Closed
                                                </span>
                                            <?php break; ?>
                                        <?php endswitch; ?>
                                    </td>
                                    <td class="text-muted small">
                                        <?php echo e(Str::limit($ticket->getLatestMessage()?->message ?? 'Chưa có tin nhắn', 60)); ?>

                                    </td>
                                    <td class="text-muted small">
                                        <?php echo e(\Carbon\Carbon::parse($ticket->created_at)->diffForHumans()); ?>

                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="<?php echo e(route('admin.support-tickets.show', $ticket)); ?>" 
                                           class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="bx bx-show me-1"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bx bx-inbox fs-1 d-block mb-3"></i>
                                        Chưa có ticket nào
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white border-0 pt-0">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <small class="text-muted">
                        Hiển thị <?php echo e($tickets->firstItem()); ?> - <?php echo e($tickets->lastItem()); ?> / <?php echo e($tickets->total()); ?> ticket
                    </small>
                    <?php echo e($tickets->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#ticketsTable tbody tr');

            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/support-tickets/index.blade.php ENDPATH**/ ?>