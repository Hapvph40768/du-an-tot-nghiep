@extends('layout.staff')

@section('content')
<div class="flex flex-col h-[calc(100vh-120px)]">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('staff.chat.index') }}" class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center hover:bg-gray-200 transition-colors">
                &larr;
            </a>
            <div>
                <h1 class="text-2xl font-bold">{{ $session->user->name ?? 'Khách vãng lai' }}</h1>
                <p class="text-sm opacity-60">Trạng thái: 
                    <span class="font-bold {{ $session->status == 'waiting_staff' ? 'text-orange-500' : 'text-green-500' }}">
                        {{ $session->status == 'waiting_staff' ? 'Đang chờ' : 'Đang hỗ trợ' }}
                    </span>
                </p>
            </div>
        </div>
        
        <form action="{{ route('staff.chat.close', $session->id) }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 hover:bg-red-100 text-sm font-bold rounded-xl transition-colors border border-red-100">
                Kết thúc & Giao lại cho AI
            </button>
        </form>
    </div>

    <!-- Chat History -->
    <div class="flex-1 bg-white dark:bg-[#111] rounded-3xl border border-gray-200 dark:border-[#262626] overflow-hidden flex flex-col shadow-sm">
        <div class="flex-1 overflow-y-auto p-6 space-y-6" id="chat-container">
            @foreach($history as $chat)
                @if($chat->role == 'user')
                    <div class="flex justify-start">
                        <div class="max-w-[80%] md:max-w-[60%] bg-gray-100 dark:bg-gray-800 p-4 rounded-2xl rounded-tl-none">
                            <div class="text-[10px] uppercase font-bold opacity-40 mb-1">Khách hàng</div>
                            <div class="text-sm">{{ $chat->message }}</div>
                            <div class="text-[10px] opacity-40 mt-1 text-right">{{ \Carbon\Carbon::parse($chat->created_at)->format('H:i') }}</div>
                        </div>
                    </div>
                @else
                    <div class="flex justify-end">
                        <div class="max-w-[80%] md:max-w-[60%] {{ $chat->role == 'staff' ? 'bg-blue-600 text-white' : 'bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800/30' }} p-4 rounded-2xl rounded-tr-none shadow-sm">
                            <div class="text-[10px] uppercase font-bold {{ $chat->role == 'staff' ? 'opacity-80' : 'text-emerald-600' }} mb-1">
                                {{ $chat->role == 'staff' ? 'Bạn (Nhân viên)' : 'Trợ lý AI' }}
                            </div>
                            <div class="text-sm">{{ $chat->message }}</div>
                            <div class="text-[10px] {{ $chat->role == 'staff' ? 'opacity-60' : 'opacity-40' }} mt-1">{{ \Carbon\Carbon::parse($chat->created_at)->format('H:i') }}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Reply Area -->
        <div class="p-4 bg-gray-50 dark:bg-[#161616] border-t border-gray-100 dark:border-[#262626]">
            <form action="{{ route('staff.chat.reply', $session->id) }}" method="POST" class="flex gap-4">
                @csrf
                <input type="text" name="message" placeholder="Nhập nội dung phản hồi khách hàng..." required
                    class="flex-1 bg-white dark:bg-[#111] border border-gray-200 dark:border-[#262626] rounded-2xl px-6 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all shadow-sm">
                <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl transition-all shadow-lg shadow-blue-500/20">
                    Gửi
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Tự động cuộn xuống cuối chat
    const container = document.getElementById('chat-container');
    container.scrollTop = container.scrollHeight;
</script>
@endsection
