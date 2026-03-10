@extends('admin.dashboard')

@section('content')

<div class="container py-4">

<div class="card shadow">

<div class="card-header bg-dark text-white">

Ticket #{{ $ticket->id }}  
Khách: {{ $ticket->user->name }}

</div>


<div class="card-body p-0">

{{-- CHAT AREA --}}
<div class="chat-box" id="chatBox">

@foreach($ticket->messages as $msg)

@if($msg->sender_id == auth()->id())

<div class="msg-row right">

<div class="msg admin">

{{ $msg->message }}

</div>

</div>

@else

<div class="msg-row left">

<div class="msg user">

<strong>{{ $msg->sender->name }}</strong><br>

{{ $msg->message }}

</div>

</div>

@endif

@endforeach

</div>


{{-- SEND MESSAGE --}}
<div class="chat-input">

<form method="POST"
action="{{ route('admin.tickets.reply',$ticket->id) }}">

@csrf

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
height:500px;
overflow-y:auto;
padding:20px;
background:#f5f7fb;
}

.msg-row{
display:flex;
margin-bottom:10px;
}

.left{
justify-content:flex-start;
}

.right{
justify-content:flex-end;
}

.msg{
padding:10px 15px;
border-radius:15px;
max-width:60%;
font-size:14px;
}

.user{
background:#e4e6eb;
}

.admin{
background:#0d6efd;
color:white;
}

.chat-input{
border-top:1px solid #ddd;
padding:10px;
background:white;
}

</style>

<script>

let box = document.getElementById("chatBox");

box.scrollTop = box.scrollHeight;

</script>

@endsection