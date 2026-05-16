@extends('layout.staff')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold mb-2">Hỗ Trợ Khách Hàng Trực Tuyến</h1>
    <p class="text-gray-500">Danh sách các yêu cầu hỗ trợ từ khách hàng thông qua AI Chat.</p>
</div>

<div class="grid grid-cols-1 gap-6">
    <div class="bg-white dark:bg-[#111] rounded-3xl shadow-sm border border-gray-200 dark:border-[#262626] overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-[#262626] flex justify-between items-center">
            <h2 class="font-bold text-lg">Cuộc hội thoại đang hoạt động</h2>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">{{ $sessions->count() }} Phiên</span>
        </div>
        
        <div class="divide-y divide-gray-100 dark:divide-[#262626]">
            @forelse($sessions as $session)
                <div class="p-6 hover:bg-gray-50 dark:hover:bg-[#161616] transition-colors flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-xl">
                            👤
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 dark:text-white">
                                {{ $session->user->name ?? 'Khách vãng lai' }} 
                                <span class="text-xs font-normal opacity-50 ml-2">ID: {{ substr($session->session_id, 0, 8) }}...</span>
                            </div>
                            <div class="text-sm opacity-60">
                                Cập nhật: {{ $session->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 w-full md:w-auto">
                        @if($session->status == 'waiting_staff')
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 text-xs font-bold rounded-lg animate-pulse">
                                🔴 Đang chờ phản hồi
                            </span>
                        @elseif($session->status == 'staff_replying')
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-lg">
                                🟢 Đang trao đổi
                            </span>
                        @endif

                        <a href="{{ route('staff.chat.show', $session->id) }}" class="flex-1 md:flex-none px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl text-center transition-colors">
                            Vào Chat
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-20 text-center text-gray-400">
                    <div class="text-4xl mb-4">🍃</div>
                    <p>Hiện không có yêu cầu hỗ trợ nào cần nhân viên can thiệp.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
