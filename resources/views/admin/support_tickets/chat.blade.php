@extends('layout.admin.AdminLayout')

@section('content-main')
    <div class="chat-box">

        @foreach ($ticket->messages as $msg)
            @if ($msg->sender_type == 'user')
                <div class="user">
                    {{ $msg->message }}
                </div>
            @elseif($msg->sender_type == 'ai')
                <div class="ai">
                    🤖 {{ $msg->message }}
                </div>
            @else
                <div class="admin">
                    Admin: {{ $msg->message }}
                </div>
            @endif
        @endforeach

    </div>

    <form method="POST" action="/support/send">

        @csrf

        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

        <input type="text" name="message">

        <button>Send</button>

    </form>
@endsection
