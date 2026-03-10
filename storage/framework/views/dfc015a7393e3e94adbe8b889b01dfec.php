

<?php $__env->startSection('content-main'); ?>
<style>
    /* CSS dự phòng để đảm bảo hiển thị đẹp kể cả khi Tailwind lỗi */
    .seat-container { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; max-width: 250px; margin: 0 auto; }
    .seat-item { 
        aspect-ratio: 1/1; display: flex; flex-direction: column; align-items: center; justify-content: center;
        border: 2px solid #e3e3e0; border-radius: 8px; background: white; cursor: pointer; transition: 0.3s; position: relative;
    }
    .seat-item:hover { border-color: #000; }
    .seat-item.occupied { background: #fff2f2; border-color: #f53003; opacity: 0.6; cursor: not-allowed; }
    .seat-item.occupied::after { 
        content: 'X'; position: absolute; color: rgba(245, 48, 3, 0.2); font-size: 40px; font-weight: bold; 
    }
    .btn-delete-small {
        position: absolute; top: -5px; right: -5px; background: #000; color: #fff; 
        width: 18px; height: 18px; border-radius: 50%; font-size: 10px; border: none; z-index: 10;
    }
    .admin-card { background: white; border-radius: 12px; border: 1px solid #e3e3e0; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
    .btn-main { background: #f53003; color: white; padding: 10px 20px; border-radius: 4px; border: none; font-weight: bold; cursor: pointer; }
</style>

<div class="p-6">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #e3e3e0; padding-bottom: 15px;">
        <div>
            <h1 style="font-size: 20px; font-weight: bold; margin: 0;">Quản lý sơ đồ: <?php echo e($vehicle->name); ?></h1>
            <p style="font-size: 13px; color: #706f6c; margin-top: 5px;">Biển số: <?php echo e($vehicle->license_plate); ?> | Loại: <?php echo e($vehicle->type); ?> chỗ</p>
        </div>
        <?php if(!$seats->isEmpty()): ?>
            <form action="<?php echo e(route('admin.vehicles.seats.deleteAll', $vehicle->id)); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" style="color: #f53003; text-decoration: underline; background: none; border: none; cursor: pointer; font-size: 13px;" onclick="return confirm('Xóa toàn bộ sơ đồ?')">Xóa tất cả ghế</button>
            </form>
        <?php endif; ?>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
        
        <div class="admin-card" style="text-align: center;">
            <div style="font-size: 11px; font-weight: bold; color: #ccc; letter-spacing: 2px; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">ĐẦU XE / TÀI XẾ</div>
            
            <div class="seat-container">
                <?php $__empty_1 = true; $__currentLoopData = $seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="seat-item <?php echo e($seat->status != 'Trống' ? 'occupied' : ''); ?>" onclick="selectSeat(<?php echo e($seat->id); ?> , '<?php echo e($seat->status); ?>')">
                        <span style="font-weight: bold; font-size: 14px;"><?php echo e($seat->seat_number); ?></span>
                        <span style="font-size: 9px; text-transform: uppercase; color: #706f6c;"><?php echo e($seat->type); ?></span>
                        
                        <form action="<?php echo e(route('admin.seats.destroy', $seat->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-delete-small">✕</button>
                        </form>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div style="grid-column: span 3; padding: 40px 0; color: #ccc;">Chưa có sơ đồ ghế</div>
                <?php endif; ?>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 20px;">
            <?php if($seats->isEmpty()): ?>
                <div class="admin-card" style="background: #fff2f2; border-color: #f5300322;">
                    <h3 style="color: #f53003; margin-top: 0;">Khởi tạo sơ đồ</h3>
                    <p style="font-size: 14px; color: #666; line-height: 1.6;">Xe này chưa có ghế. Bạn có muốn tự động tạo <strong><?php echo e($vehicle->type); ?> ghế</strong> từ A01 đến A<?php echo e($vehicle->type); ?> không?</p>
                    <form action="<?php echo e(route('admin.vehicles.seats.generate', $vehicle->id)); ?>" method="POST" style="margin-top: 20px;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-main">Khởi tạo ngay</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="admin-card">
                    <h3 style="margin-top: 0;">Hướng dẫn</h3>
                    <div style="display: flex; flex-direction: column; gap: 15px; font-size: 13px; color: #555;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 15px; height: 15px; border: 1px solid #ccc; background: white;"></div>
                            <span>Ghế trống: Click vào để chọn vị trí.</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 15px; height: 15px; border: 1px solid #f53003; background: #fff2f2;"></div>
                            <span>Ghế đã chọn: Bị mờ và không thể click.</span>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <p style="font-size: 11px; color: #aaa; font-weight: bold; text-transform: uppercase; margin-bottom: 15px;">Admin: Thêm ghế đơn lẻ</p>
                    <form action="<?php echo e(route('admin.vehicles.seats.store', $vehicle->id)); ?>" method="POST" style="display: flex; gap: 10px;">
                        <?php echo csrf_field(); ?>
                        <input type="text" name="seat_number" placeholder="Số ghế" style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
                        <select name="type" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="Thường">Thường</option>
                            <option value="VIP">VIP</option>
                        </select>
                        <input type="hidden" name="status" value="Trống">
                        <button type="submit" style="background: #000; color: #fff; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">Thêm</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function selectSeat(seatId, status) {
        if(status !== 'Trống') return;
        if(!confirm('Xác nhận đặt ghế này?')) return;

        fetch(`/admin/seats/${seatId}/select`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json'
            }
        }).then(res => res.json()).then(data => {
            if(data.success) { alert(data.success); window.location.reload(); }
            else { alert(data.error); }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/admin/seats/index.blade.php ENDPATH**/ ?>