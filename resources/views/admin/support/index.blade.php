@extends('admin.dashboard')

@section('content')

<div class="container-fluid py-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<h3 class="fw-bold">
🎧 Support Tickets
</h3>

<span class="badge bg-dark fs-6">
{{ $tickets->count() }} Tickets
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

@forelse($tickets as $ticket)

<tr>

<td class="fw-bold text-dark">
#{{ $ticket->id }}
</td>

<td>

<div class="d-flex align-items-center gap-2">

<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
style="width:35px;height:35px">

{{ strtoupper(substr($ticket->user->name,0,1)) }}

</div>

<div>

<div class="fw-semibold">
{{ $ticket->user->name }}
</div>

<small class="text-muted">
{{ $ticket->user->email }}
</small>

</div>

</div>

</td>

<td>

@if($ticket->type == 'payment')

<span class="badge bg-primary">
💳 Payment
</span>

@elseif($ticket->type == 'ticket')

<span class="badge bg-info text-dark">
🎫 Ticket
</span>

@else

<span class="badge bg-danger">
⚠ Complaint
</span>

@endif

</td>

<td class="text-muted" style="max-width:250px">

{{ \Illuminate\Support\Str::limit($ticket->description,70) }}

</td>

<td>

@if($ticket->status == 'open')

<span class="badge rounded-pill bg-danger">
Open
</span>

@elseif($ticket->status == 'processing')

<span class="badge rounded-pill bg-warning text-dark">
Processing
</span>

@else

<span class="badge rounded-pill bg-success">
Closed
</span>

@endif

</td>

<td>

<small class="text-muted">
{{ $ticket->created_at->format('d M Y') }}
</small>

<br>

<small class="text-secondary">
{{ $ticket->created_at->format('H:i') }}
</small>

</td>

<td class="text-center">

<a href="{{ route('admin.tickets.show',$ticket->id) }}"
class="btn btn-sm btn-dark px-3">

💬 Chat

</a>

</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center py-4 text-muted">

No support tickets found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

</div>

@endsection