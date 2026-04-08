<?php $__env->startSection('title', 'Quản lý Đặt vé'); ?>

<?php $__env->startSection('content-main'); ?>
<style>
    :root { --primary-color: #ff6b00; --primary-hover: #e65100; }
    .card-box { background: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; }
    .custom-table { width: 100%; border-collapse: separate; border-spacing: 0; table-layout: fixed; }
    .custom-table thead th { background-color: #f9fafb; color: #6b7280; font-weight: 600; font-size: 11px; text-transform: uppercase; padding: 16px; border-bottom: 2px solid #edf2f7; }
    .custom-table td { padding: 16px; vertical-align: middle; border-bottom: 1px solid #f3f4f6; font-size: 14px; }
    
    /* Badge trạng thái đơn hàng */
    .badge-booking { padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; display: inline-block; }
    .status-pending { background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5; }
    .status-paid { background: #f0fdf4; color: #15803d; border: 1px solid #dcfce7; }
    .status-cancelled { background: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2; }
    
    .booking-id { font-family: 'Monaco', 'Consolas', monospace; color: #ff6b00; font-weight: 700; }
    .price-total { font-weight: 800; color: #111827; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark m-0">Danh sách Đặt vé</h2>
            <p class="text-muted small mb-0">Theo dõi đơn hàng và trạng thái thanh toán từ khách hàng</p>
        </div>
        
        <button class="btn btn-outline-secondary btn-sm rounded-3">
            <i class='bx bx-export'></i> Xuất báo cáo
        </button>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
            <i class='bx bx-check-circle me-2'></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="card-box">
        <div class="table-responsive">
            <table class="custom-table w-100">
                <thead>
                    <tr>
                        <th style="width: 12%;">Mã Đơn</th>
                        <th style="width: 20%;">Khách hàng</th>
                        <th style="width: 20%;">Chuyến xe / Tuyến</th>
                        <th style="width: 13%;">Tổng tiền</th>
                        <th style="width: 15%;">Trạng thái</th>
                        <th style="width: 12%;">Ngày đặt</th>
                        <th class="text-end" style="width: 8%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr>
                            <td>
                                <span class="booking-id">#BK<?php echo e(str_pad($booking->id, 5, '0', STR_PAD_LEFT)); ?></span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark"><?php echo e($booking->user->name); ?></div>
                                <div class="text-muted small"><?php echo e($booking->user->phone); ?></div>
                            </td>
                            <td>
                                <div class="small fw-bold text-truncate">
                                    <?php echo e($booking->trip->route->departureLocation->name); ?> → <?php echo e($booking->trip->route->destinationLocation->name); ?>

                                </div>
                                <div class="text-muted small">
                                    <?php echo e(\Carbon\Carbon::parse($booking->trip->trip_date)->format('d/m/Y')); ?> | <?php echo e($booking->trip->departure_time); ?>

                                </div>
                            </td>
                            <td>
                                <span class="price-total"><?php echo e(number_format($booking->total_price)); ?>đ</span>
                            </td>
                            <td>
                                <span class="badge-booking status-<?php echo e($booking->status); ?>">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->status == 'pending'): ?> <i class='bx bx-time-five'></i> CHỜ TT
                                    <?php elseif($booking->status == 'paid'): ?> <i class='bx bx-check-shield'></i> ĐÃ THANH TOÁN
                                    <?php else: ?> <i class='bx bx-x-circle'></i> ĐÃ HỦY
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </span>
                            </td>
                            <td>
                                <div class="text-muted small"><?php echo e($booking->created_at->format('d/m/Y')); ?></div>
                                <div class="text-muted" style="font-size: 10px;"><?php echo e($booking->created_at->format('H:i')); ?></div>
                            </td>
                            <td class="text-end">
                                <a href="<?php echo e(route('admin.bookings.show', $booking->id)); ?>" class="btn btn-sm btn-light border shadow-sm">
                                    <i class='bx bx-show-alt text-primary'></i> Xem
                                </a>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class='bx bx-receipt fs-1 d-block mb-2 opacity-25'></i>
                                Chưa có đơn đặt vé nào trong hệ thống.
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($bookings->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/bookings/index.blade.php ENDPATH**/ ?>