<div class="chatbox-wrapper">
    <button class="chat-toggle-btn" wire:click="toggleChat">
        <i class='bx <?php echo e($isOpen ? 'bx-x' : 'bx-message-rounded-dots'); ?>'></i>
    </button>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isOpen): ?>
        <div class="chat-container shadow-lg border">
            
            <div class="chat-header bg-primary text-white p-2 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-primary dropdown-toggle border-0 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bx-menu-alt-left fs-5'></i>
                        </button>
                        <ul class="dropdown-menu shadow border-0 mt-2" style="width: 260px; max-height: 300px; overflow-y: auto; border-radius: 10px;">
                            <li><h6 class="dropdown-header text-primary"><i class='bx bx-list-ul'></i> Vấn đề của bạn</h6></li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <li>
                                    <a class="dropdown-item py-2 <?php echo e($selectedTicketId == $t->id ? 'bg-light fw-bold text-primary' : ''); ?>" 
                                       href="#" wire:click.prevent="selectTicket(<?php echo e($t->id); ?>)">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-truncate" style="max-width: 150px;">#<?php echo e($t->id); ?> - <?php echo e($t->description); ?></span>
                                            <span class="badge <?php echo e($t->status == 'open' ? 'bg-success' : 'bg-warning'); ?>" style="font-size: 8px;"><?php echo e($t->status); ?></span>
                                        </div>
                                    </a>
                                </li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <li><span class="dropdown-item small text-muted">Chưa có yêu cầu nào</span></li>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-center text-primary fw-bold py-2" href="<?php echo e(route('customer.support.create')); ?>">
                                    <i class='bx bx-plus-circle'></i> Tạo vấn đề mới
                                </a>
                            </li>
                        </ul>
                    </div>
                    <span class="fw-bold ms-1" style="font-size: 14px;">Hỗ trợ trực tuyến</span>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedTicketId): ?>
                    <span class="badge bg-white text-primary" style="font-size: 10px; opacity: 0.9;">ID: #<?php echo e($selectedTicketId); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="chat-body p-2" id="chat-window" wire:poll.3s>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedTicketId): ?>
                    <?php
                        $currentTicket = $tickets->firstWhere('id', $selectedTicketId);
                    ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentTicket): ?>
                        
                        <div class="d-flex mb-3 justify-content-start">
                            <div class="p-2 rounded-3 shadow-sm bg-white border-start border-4 border-warning"
                                style="max-width: 85%;">
                                <div class="small fw-bold text-primary mb-1" style="font-size: 10px; text-transform: uppercase;">
                                    <i class='bx bx-info-circle'></i> Vấn đề cần hỗ trợ:
                                </div>
                                <div style="font-size: 13px; color: #333; line-height: 1.4;"><?php echo e($currentTicket->description); ?></div>
                                <div class="text-muted mt-1" style="font-size: 9px; text-align: right;">
                                    <?php echo e($currentTicket->created_at->format('H:i')); ?>

                                </div>
                            </div>
                        </div>

                        <div class="text-center my-3" style="position: relative;">
                            <hr style="border-top: 1px dashed #ccc;">
                            <span class="bg-light px-2 text-muted" style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); font-size: 10px;">
                                Phản hồi từ chúng tôi
                            </span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $chatHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="d-flex mb-3 <?php echo e($msg->sender_id === Auth::id() ? 'justify-content-end' : 'justify-content-start'); ?>">
                            <div class="p-2 rounded-3 shadow-sm <?php echo e($msg->sender_id === Auth::id() ? 'bg-primary text-white' : 'bg-white border'); ?>"
                                style="max-width: 85%; font-size: 13px;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($msg->sender_id !== Auth::id()): ?>
                                    <div class="fw-bold mb-1" style="font-size: 10px; color: #666;">
                                        <?php echo e($msg->sender_type === 'admin' ? 'Nhân viên hỗ trợ' : 'Khách hàng'); ?>

                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php echo e($msg->message); ?>

                                <div style="font-size: 9px; opacity: 0.7; text-align: right; margin-top: 3px;">
                                    <?php echo e($msg->created_at->format('H:i')); ?>

                                </div>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php else: ?>
                    
                    <div class="text-center py-5">
                        <i class='bx bx-message-alt-detail fs-1 text-muted opacity-25'></i>
                        <p class="small text-muted mt-2 px-4">Vui lòng chọn hoặc tạo vấn đề mới để bắt đầu chat.</p>
                        <a href="<?php echo e(route('customer.support.create')); ?>" class="btn btn-primary btn-sm rounded-pill px-3">Tạo yêu cầu</a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedTicketId): ?>
                <div class="chat-footer p-2 border-top bg-white">
                    <div class="input-group">
                        <input type="text" wire:model="newMessage" wire:keydown.enter="sendMessage"
                            class="form-control form-control-sm border-0 bg-light" placeholder="Nhập tin nhắn...">
                        <button wire:click="sendMessage" class="btn btn-primary btn-sm px-3 rounded-end shadow-none">
                            <i class='bx bxs-send'></i>
                        </button>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <style>
        /* CSS giữ nguyên như bản cũ của bạn, thêm chỉnh sửa cho dropdown */
        .dropdown-item:active { background-color: #ff5b24; }
        .chat-footer .input-group { background: #f8f9fa; border-radius: 20px; overflow: hidden; padding: 2px 5px; border: 1px solid #eee; }
        .chatbox-wrapper { position: fixed; bottom: 20px; right: 20px; z-index: 9999; font-family: 'Inter', sans-serif; }
        .chat-toggle-btn { width: 55px; height: 55px; border-radius: 50%; background: #ff5b24; color: white; border: none; font-size: 26px; cursor: pointer; box-shadow: 0 4px 15px rgba(255, 91, 36, 0.4); }
        .chat-container { width: 330px; height: 480px; background: white; border-radius: 15px; position: absolute; bottom: 70px; right: 0; display: flex; flex-direction: column; overflow: hidden; }
        .chat-body { flex: 1; overflow-y: auto; background: #fdfdfd; }
        /* Bo góc Messenger style */
        .justify-content-end .p-2 { border-bottom-right-radius: 2px !important; }
        .justify-content-start .p-2 { border-bottom-left-radius: 2px !important; }
        .chat-body::-webkit-scrollbar { width: 4px; }
        .chat-body::-webkit-scrollbar-thumb { background: #eee; border-radius: 10px; }
    </style>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('scroll-to-bottom', () => {
                setTimeout(() => {
                    const objDiv = document.getElementById("chat-window");
                    if(objDiv) objDiv.scrollTop = objDiv.scrollHeight;
                }, 100);
            });
        });
    </script>
</div><?php /**PATH C:\laragon\www\du-an-tot-nghiep\resources\views/livewire/chatbox.blade.php ENDPATH**/ ?>