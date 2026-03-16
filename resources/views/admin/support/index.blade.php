@extends('layout.admin.AdminLayout')

@section('content-main')

<table class="table">

<tr>
<th>ID</th>
<th>User</th>
<th>Status</th>
<th></th>
</tr>

@foreach($tickets as $ticket)

<tr>

<td>{{ $ticket->id }}</td>

<td>{{ $ticket->user->name }}</td>

<td>{{ $ticket->status }}</td>

<td>

<a href="/admin/support/{{ $ticket->id }}">
Chat
</a>

</td>

</tr>

@endforeach

</table>
@endsection