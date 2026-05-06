<?php $__env->startSection('title', 'Quản lý Đánh giá khách hàng'); ?>

<?php $__env->startSection('content-main'); ?>
<style>
    :root { --primary-color: #ff6b00; --star-color: #ffb400; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; }
    .custom-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .custom-table thead th { background-color: #f9fafb; color: #6b7280; font-weight: 600; font-size: 11px; text-transform: uppercase; padding: 16px; border-bottom: 2px solid #edf2f7; }
    .custom-table td { padding: 16px; vertical-align: middle; border-bottom: 1px solid #f3f4f6; font-size: 14px; }
    
    .star-rating { color: var(--star-color); font-size: 16px; }
    .review-content { font-style: italic; color: #4b5563; max-width: 300px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .trip-info { background: #f3f4f6; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600; color: #374151; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark m-0">Đánh giá từ khách hàng</h2>
            <p class="text-muted small mb-0">Lắng nghe phản hồi và xử lý các đánh giá vi phạm</p>
        </div>
        <div class="badge bg-white border text-dark p-2 rounded-3 shadow-sm">
            <span class="text-muted">Tổng số:</span> <span class="fw-bold"><?php echo e($reviews->total()); ?></span>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class='bx bx-check-circle me-2'></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="card-box">
        <div class="table-responsive">
            <table class="custom-table w-100">
                <thead>
                    <tr>
                        <th style="width: 15%;">Khách hàng</th>
                        <th style="width: 15%;">Mức độ hài lòng</th>
                        <th style="width: 30%;">Nội dung nhận xét</th>
                        <th style="width: 25%;">Chuyến đi / Tuyến</th>
                        <th style="width: 15%; text-align: right;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr>
                            <td>
                                <div class="fw-bold text-dark"><?php echo e($review->user->name); ?></div>
                                <div class="text-muted" style="font-size: 11px;"><?php echo e($review->created_at->format('d/m/Y H:i')); ?></div>
                            </td>
                            <td>
                                <div class="star-rating">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 5; $i++): ?>
                                        <i class='bx <?php echo e($i <= $review->rating ? "bxs-star" : "bx-star"); ?>'></i>
                                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <span class="small text-muted"><?php echo e($review->rating); ?>/5 sao</span>
                            </td>
                            <td>
                                <div class="review-content" title="<?php echo e($review->comment); ?>">
                                    "<?php echo e($review->comment); ?>"
                                </div>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($review->booking && $review->booking->trip): ?>
                                    <div class="trip-info mb-1">
                                        <i class='bx bx-map-pin'></i> <?php echo e($review->booking->trip->route->departureLocation->name ?? 'N/A'); ?> 
                                        → <?php echo e($review->booking->trip->route->destinationLocation->name ?? 'N/A'); ?>

                                    </div>
                                    <div class="small text-muted">
                                        Ngày: <?php echo e(\Carbon\Carbon::parse($review->booking->trip->trip_date)->format('d/m/Y')); ?>

                                    </div>
                                <?php else: ?>
                                    <span class="text-muted italic small">Dữ liệu chuyến đi đã bị xóa</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="text-end">
                                <form action="<?php echo e(route('admin.reviews.destroy', $review->id)); ?>" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này? Hành động này không thể hoàn tác.')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-light border text-danger shadow-sm">
                                        <i class='bx bx-trash-alt'></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class='bx bx-chat fs-1 d-block mb-2 opacity-25'></i>
                                Chưa có đánh giá nào từ khách hàng.
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($reviews->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views\admin\reviews\index.blade.php ENDPATH**/ ?>