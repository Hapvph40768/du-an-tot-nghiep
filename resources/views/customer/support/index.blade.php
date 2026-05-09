@extends('layout.customer.CustomerLayout')

@section('content-main')
<section class="py-12 lg:py-20 relative min-h-[80vh]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6 mb-10">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tight uppercase flex items-center gap-3">
                    <i data-lucide="life-buoy" class="w-8 h-8 text-brand-primary"></i> Hỗ trợ của tôi
                </h2>
                <p class="text-white/50 mt-1">Gửi yêu cầu hỗ trợ hoặc chat trực tiếp với AI</p>
            </div>
            
            <a href="{{ route('customer.support.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 liquid-gradient text-white font-bold py-3 px-6 rounded-xl shadow-[0_10px_40px_-10px_rgba(255,91,36,0.6)] hover:scale-105 transition-transform text-sm">
                <i data-lucide="plus" class="w-4 h-4"></i> Tạo yêu cầu mới
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl mb-8 flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-brand-primary/5 rounded-full blur-[60px] pointer-events-none"></div>
            
            @if($tickets->isEmpty())
                <div class="p-16 text-center text-white/50 flex flex-col items-center">
                    <i data-lucide="message-square-off" class="w-16 h-16 mb-4 opacity-50"></i>
                    <p class="text-lg">Bạn chưa có yêu cầu hỗ trợ nào.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-black/20 text-xs uppercase font-bold text-white/40 tracking-wider">
                                <th class="p-5 pl-6 border-b border-white/5">Mã</th>
                                <th class="p-5 border-b border-white/5">Loại hỗ trợ</th>
                                <th class="p-5 border-b border-white/5">Mô tả ngắn</th>
                                <th class="p-5 border-b border-white/5">Trạng thái</th>
                                <th class="p-5 border-b border-white/5">Ngày tạo</th>
                                <th class="p-5 pr-6 border-b border-white/5 text-right">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($tickets as $ticket)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="p-5 pl-6 text-white/60 font-mono text-sm group-hover:text-white transition-colors">#{{ $ticket->id }}</td>
                                    <td class="p-5">
                                        <span class="inline-flex items-center gap-1.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 px-3 py-1 rounded-full text-xs font-bold">
                                            <i data-lucide="tag" class="w-3 h-3"></i> {{ $ticket->type ?? 'Hỗ trợ chung' }}
                                        </span>
                                    </td>
                                    <td class="p-5 text-white/70 max-w-[200px] truncate group-hover:text-white transition-colors">
                                        {{ $ticket->description }}
                                    </td>
                                    <td class="p-5">
                                        @if($ticket->status == 'open')
                                            <span class="inline-flex items-center gap-1.5 bg-green-500/10 text-green-400 border border-green-500/20 px-3 py-1 rounded-full text-xs font-bold">
                                                <i data-lucide="unlock" class="w-3 h-3"></i> Đang mở
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 bg-white/10 text-white/50 border border-white/10 px-3 py-1 rounded-full text-xs font-bold">
                                                <i data-lucide="lock" class="w-3 h-3"></i> Đã đóng
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-5 text-white/50 text-sm">
                                        {{ $ticket->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="p-5 pr-6 text-right">
                                        <button onclick="Livewire.dispatch('selectTicket', { id: {{ $ticket->id }} })" class="inline-flex items-center gap-2 bg-white/10 hover:bg-brand-primary text-white border border-white/10 hover:border-brand-primary px-4 py-2 rounded-lg text-sm font-medium transition-all group-hover:shadow-[0_0_20px_rgba(255,91,36,0.2)]">
                                            <i data-lucide="bot" class="w-4 h-4"></i> Chat AI
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
