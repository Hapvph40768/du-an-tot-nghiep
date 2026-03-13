<?php $__env->startSection('content-main'); ?>

<div class="container py-4">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

🎧 Chat Support #<?php echo e($ticket->id); ?>


</div>

<div class="card-body p-0">


<div class="chat-box p-3" id="chatBox">

<?php $__currentLoopData = $ticket->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if($msg->sender_id == auth()->id()): ?>

<div class="d-flex justify-content-end mb-3">

<div class="chat-bubble bg-primary text-white">

<?php echo e($msg->message); ?>


<div class="chat-time">
<?php echo e(\Carbon\Carbon::parse($msg->created_at)->format('H:i')); ?>

</div>

</div>

</div>

<?php else: ?>

<div class="d-flex justify-content-start mb-3">

<div class="chat-bubble bg-light border">

<strong><?php echo e($msg->sender->name); ?></strong><br>

<?php echo e($msg->message); ?>


<div class="chat-time text-muted">
<?php echo e(\Carbon\Carbon::parse($msg->created_at)->format('H:i')); ?>

</div>

</div>

</div>

<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>



<div class="border-top p-3 bg-light">

<form method="POST"
action="<?php echo e(route('customer.support.send',$ticket->id)); ?>">

<?php echo csrf_field(); ?>

<div class="input-group">

<input type="text"
name="message"
class="form-control"
placeholder="Nhập tin nhắn..."
required>

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

.chat-box{
height:400px;
overflow-y:auto;
background:#f5f7fb;
}

.chat-bubble{
max-width:60%;
padding:10px 15px;
border-radius:15px;
font-size:14px;
}

.chat-time{
font-size:11px;
margin-top:4px;
text-align:right;
}

</style>

<script>

let chat = document.getElementById("chatBox");
chat.scrollTop = chat.scrollHeight;

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.home', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\du-an-tot-nghiep\resources\views/customer/support/chat.blade.php ENDPATH**/ ?>