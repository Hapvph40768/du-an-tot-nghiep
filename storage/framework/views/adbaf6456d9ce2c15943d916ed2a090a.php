<?php $__env->startSection('content-main'); ?>
    <div class="container py-4">

        <div class="card shadow">

            <div class="card-header bg-dark text-white">

                Ticket #<?php echo e($supportTicket->id); ?>

                Khách: <?php echo e($supportTicket->user->name); ?>


            </div>

            <div class="card-body p-0">

                
                <div class="chat-box" id="chatBox">

                    <?php $__currentLoopData = $supportTicket->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($msg->sender_id == auth()->id()): ?>
                            <div class="msg-row right">
                                <div class="msg admin">
                                    <?php echo e($msg->message); ?>

                                </div>
                            </div>
                        <?php else: ?>
                            <div class="msg-row left">
                                <div class="msg user">
                                    <strong><?php echo e($msg->sender->name); ?></strong><br>
                                    <?php echo e($msg->message); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

                
                <div class="chat-input">

                    <form id="chatForm">

                        <?php echo csrf_field(); ?>

                        <div class="input-group">

                            <input type="text" id="messageInput" name="message" class="form-control"
                                placeholder="Nhập tin nhắn..." required>

                            <button class="btn btn-primary">
                                Gửi
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <style>
        .chat-box {
            height: 500px;
            overflow-y: auto;
            padding: 20px;
            background: #f5f7fb;
        }

        .msg-row {
            display: flex;
            margin-bottom: 10px;
        }

        .left {
            justify-content: flex-start;
        }

        .right {
            justify-content: flex-end;
        }

        .msg {
            padding: 10px 15px;
            border-radius: 15px;
            max-width: 60%;
            font-size: 14px;
        }

        .user {
            background: #e4e6eb;
        }

        .admin {
            background: #0d6efd;
            color: white;
        }

        .chat-input {
            border-top: 1px solid #ddd;
            padding: 10px;
            background: white;
        }
    </style>


    <script>
        let chatBox = document.getElementById("chatBox")
        let form = document.getElementById("chatForm")
        let input = document.getElementById("messageInput")

        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight
        }

        form.addEventListener("submit", function(e) {

            e.preventDefault()

            let message = input.value

            fetch("<?php echo e(route('admin.support.reply', $supportTicket->id)); ?>", {

                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                    },

                    body: JSON.stringify({
                        message: message
                    })

                })

                .then(res => res.json())

                .then(data => {

                    let html = `<div class="msg-row right"><div class="msg admin">${data.message}</div></div>`

                    chatBox.innerHTML += html

                    input.value = ""

                    chatBox.scrollTop = chatBox.scrollHeight

                })

        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/support/chat.blade.php ENDPATH**/ ?>