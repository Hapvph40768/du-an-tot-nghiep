<?php $__env->startSection('content-main'); ?>

<div class="container-fluid py-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<h3 class="fw-bold">
🎧 Support Tickets
</h3>

<span class="badge bg-dark fs-6">
<?php echo e($tickets->count()); ?> Tickets
</span>

</div>

<div class="card border-0 shadow-lg">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-light">

<tr class="text-muted">

<th>#ID</th>
<th>Customer</th>
<th>Type</th>
<th>Description</th>
<th>Status</th>
<th>Date</th>
<th class="text-center">Action</th>

</tr>

</thead>

<tbody>

<?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

<tr>

<td class="fw-bold text-dark">
#<?php echo e($ticket->id); ?>

</td>

<td>

<div class="d-flex align-items-center gap-2">

<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
style="width:35px;height:35px">

<?php echo e(strtoupper(substr($ticket->user->name,0,1))); ?>


</div>

<div>

<div class="fw-semibold">
<?php echo e($ticket->user->name); ?>

</div>

<small class="text-muted">
<?php echo e($ticket->user->email); ?>

</small>

</div>

</div>

</td>

<td>

<?php if($ticket->type == 'payment'): ?>

<span class="badge bg-primary">
💳 Payment
</span>

<?php elseif($ticket->type == 'ticket'): ?>

<span class="badge bg-info text-dark">
🎫 Ticket
</span>

<?php else: ?>

<span class="badge bg-danger">
⚠ Complaint
</span>

<?php endif; ?>

</td>

<td class="text-muted" style="max-width:250px">

<?php echo e(\Illuminate\Support\Str::limit($ticket->description,70)); ?>


</td>

<td>

<?php if($ticket->status == 'open'): ?>

<span class="badge rounded-pill bg-danger">
Open
</span>

<?php elseif($ticket->status == 'processing'): ?>

<span class="badge rounded-pill bg-warning text-dark">
Processing
</span>

<?php else: ?>

<span class="badge rounded-pill bg-success">
Closed
</span>

<?php endif; ?>

</td>

<td>

<small class="text-muted">
<?php echo e(\Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y')); ?>

</small>

<br>

<small class="text-secondary">
<?php echo e(\Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y H:i')); ?>

</small>

</td>

<td class="text-center">

<a href="<?php echo e(route('admin.support.chat',$ticket->id)); ?>"
class="btn btn-sm btn-dark px-3">

💬 Chat

</a>

</td>

</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<tr>

<td colspan="7" class="text-center py-4 text-muted">

No support tickets found

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin.AdminLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Code\Tuan\du-an-tot-nghiep\resources\views/admin/support/index.blade.php ENDPATH**/ ?>