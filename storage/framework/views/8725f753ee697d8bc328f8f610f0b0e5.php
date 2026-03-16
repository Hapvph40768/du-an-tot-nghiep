<div>
    <button wire:click="$toggle('isOpen')" class="fixed-chat-btn shadow-lg">
        <i class='bx <?php echo e($isOpen ? 'bx-x' : 'bx-message-rounded-dots'); ?>'></i>
    </button>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isOpen): ?>
        <div class="chat-container shadow-2xl">
            <div class="chat-header">Hỗ trợ khách hàng AI</div>

            <div class="chat-body" id="chat-window" wire:poll.3s>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step == 'list'): ?>
                    <p class="text-muted small">Chọn Ticket để bắt đầu:</p>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tickets->isEmpty()): ?>
                        <div class="text-center py-5">
                            <i class='bx bx-info-circle fs-1 text-muted mb-2'></i>
                            <p class="small text-muted">Bạn chưa có yêu cầu hỗ trợ nào.</p>
                            
                            <a href="<?php echo e(route('admin.support-tickets.index')); ?>"
                                class="btn btn-sm btn-primary rounded-pill px-3">
                                Tạo yêu cầu ngay
                            </a>
                        </div>
                    <?php else: ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <div class="d-flex align-items-center mb-3">
                        <button wire:click="$set('step', 'list')" class="btn-back">
                            <i class='bx bx-left-arrow-alt'></i> Quay lại
                        </button>
                        <span class="ms-auto badge bg-light text-dark">#<?php echo e($selectedTicketId); ?></span>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $chatHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="msg-wrapper <?php echo e($msg->sender_type == 'user' ? 'user' : 'ai'); ?>">
                            <div class="msg-bubble shadow-sm">
                                <?php echo e($msg->message); ?>

                                <div style="font-size: 9px; opacity: 0.6; margin-top: 4px;">
                                    <?php echo e($msg->created_at->format('H:i')); ?>

                                </div>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <p class="text-center text-muted small mt-5">Chưa có tin nhắn nào trong cuộc hội thoại này.</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step == 'chat'): ?>
                <div class="chat-footer">
                    <input type="text" wire:model="newMessage" wire:keydown.enter="sendMessage"
                        placeholder="Nhập tin nhắn..." autocomplete="off">
                    <button wire:click="sendMessage" wire:loading.attr="disabled">
                        <i class='bx bx-send'></i>
                    </button>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <style>
        /* CSS Giữ nguyên như cũ nhưng đảm bảo .ticket-item hiển thị rõ */
        .fixed-chat-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #ff5b24;
            color: white;
            border: none;
            font-size: 30px;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-container {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 350px;
            height: 500px;
            background: white;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            border: 1px solid #eee;
            overflow: hidden;
        }

        .chat-header {
            background: #ff5b24;
            color: white;
            padding: 15px;
            font-weight: bold;
        }

        .chat-body {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            background: #f9f9f9;
        }

        .ticket-item {
            background: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            border: 1px solid #eee;
            transition: all 0.2s;
        }

        .ticket-item:hover {
            border-color: #ff5b24;
            background: #fff5f2;
        }

        .msg-wrapper {
            display: flex;
            margin-bottom: 12px;
        }

        .msg-wrapper.user {
            justify-content: flex-end;
        }

        .msg-bubble {
            max-width: 85%;
            padding: 10px 14px;
            border-radius: 15px;
            font-size: 13px;
        }

        .user .msg-bubble {
            background: #ff5b24;
            color: white;
            border-bottom-right-radius: 2px;
        }

        .ai .msg-bubble {
            background: white;
            color: #333;
            border: 1px solid #eee;
            border-bottom-left-radius: 2px;
        }

        .chat-footer {
            padding: 12px;
            border-top: 1px solid #eee;
            display: flex;
            background: white;
        }

        .chat-footer input {
            flex: 1;
            border: 1px solid #eee;
            border-radius: 20px;
            padding: 8px 15px;
            outline: none;
            font-size: 13px;
        }

        .chat-footer button {
            background: none;
            border: none;
            color: #ff5b24;
            font-size: 24px;
            margin-left: 8px;
        }

        .btn-back {
            background: none;
            border: none;
            color: #ff5b24;
            font-size: 13px;
            font-weight: bold;
        }
    </style>
</div>
<?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/livewire/chatbox.blade.php ENDPATH**/ ?>