<?php $__env->startSection('content-main'); ?>
<div class="container-fluid py-4">
    <a href="<?php echo e(route('admin.support_tickets.index')); ?>" class="btn btn-link text-decoration-none mb-3 p-0">
        <i class='bx bx-arrow-back'></i> Quay lại danh sách
    </a>

    <div class="row">
        
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">Thông tin yêu cầu</div>
                <div class="card-body">
                    
                    <p><strong>Khách hàng:</strong> <?php echo e($supportTicket->user->name ?? 'Không có thông tin'); ?></p>
                    <p><strong>Số điện thoại:</strong> <?php echo e($supportTicket->user->phone ?? 'Không có thông tin'); ?></p>
                    <p><strong>Vấn đề:</strong> <?php echo e($supportTicket->description); ?></p>
                    <hr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($supportTicket->booking): ?>
                        <p class="text-primary fw-bold">Thông tin vé xe:</p>
                        <p>Mã đặt vé: #<?php echo e($supportTicket->booking->id); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between">
                    <span class="fw-bold text-primary">Lịch sử trò chuyện</span>
                    <form action="<?php echo e(route('admin.support_tickets.close', $supportTicket->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <button class="btn btn-sm btn-outline-secondary">Đóng Ticket</button>
                    </form>
                </div>
                <div class="card-body bg-light" style="height: 400px; overflow-y: auto;" id="admin-chat-box">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $supportTicket->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="d-flex mb-3 <?php echo e($msg->sender_type == 'admin' ? 'justify-content-end' : 'justify-content-start'); ?>">
                            <div class="p-3 rounded-4 shadow-sm <?php echo e($msg->sender_type == 'admin' ? 'bg-primary text-white' : 'bg-white'); ?>" style="max-width: 75%;">
                                <div class="small fw-bold mb-1"><?php echo e($msg->sender_type == 'admin' ? 'Bạn' : $supportTicket->user->name); ?></div>
                                <div><?php echo e($msg->message); ?></div>
                                <div class="text-end" style="font-size: 10px; opacity: 0.7;"><?php echo e($msg->created_at->format('H:i')); ?></div>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <form action="<?php echo e(route('admin.support_tickets.reply', $supportTicket->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="input-group">
                            <input name="message" type="text" class="form-control border-0 bg-light" placeholder="Nhập phản hồi cho khách hàng..." required>
                            <button class="btn btn-primary px-4">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\du-an-tot-nghiep-main\resources\views/admin/support_tickets/show.blade.php ENDPATH**/ ?>