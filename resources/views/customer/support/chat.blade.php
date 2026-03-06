@extends('customer.home')

@section('content')

<div class="container py-4">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

🎧 Chat Support #{{ $ticket->id }}

</div>

<div class="card-body p-0">

{{-- CHAT BOX --}}
<div class="chat-box p-3" id="chatBox">

@foreach($ticket->messages as $msg)

@if($msg->sender_id == auth()->id())

<div class="d-flex justify-content-end mb-3">

<div class="chat-bubble bg-primary text-white">

{{ $msg->message }}

<div class="chat-time">
{{ $msg->created_at->format('H:i') }}
</div>

</div>

</div>

@else

<div class="d-flex justify-content-start mb-3">

<div class="chat-bubble bg-light border">

<strong>{{ $msg->sender->name }}</strong><br>

{{ $msg->message }}

<div class="chat-time text-muted">
{{ $msg->created_at->format('H:i') }}
</div>

</div>

</div>

@endif

@endforeach

</div>


{{-- INPUT CHAT --}}
<div class="border-top p-3 bg-light">

<form method="POST"
action="{{ route('customer.support.send',$ticket->id) }}">

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

@endsection