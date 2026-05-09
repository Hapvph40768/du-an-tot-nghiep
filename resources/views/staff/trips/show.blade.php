@extends('layout.staff')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('staff.trips.index') }}" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/></svg>
    </a>
    <h1 class="text-2xl font-bold">Chi tiết Chuyến xe: {{ $trip->route->startLocation->name }} &rarr; {{ $trip->route->endLocation->name }}</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white dark:bg-[#111111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <h3 class="text-xs font-bold uppercase opacity-40 mb-6 tracking-widest">Sơ đồ ghế</h3>
            
            <div class="max-w-[200px] mx-auto p-4 bg-gray-50 dark:bg-[#1a1a1a] rounded-2xl border-4 border-gray-200 dark:border-[#262626] relative">
                <div class="absolute top-2 right-4 w-6 h-6 bg-gray-400 rounded-lg flex items-center justify-center text-[10px] text-white font-bold">Vô lăn</div>
                
                <div class="grid grid-cols-2 gap-4 mt-12 pb-4">
                    @foreach($seats as $seat)
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl font-bold text-sm shadow-sm transition-all
                            {{ in_array($seat->id, $occupiedSeatIds) 
                                ? 'bg-blue-600 text-white shadow-blue-500/50 scale-105' 
                                : 'bg-white dark:bg-[#262626] border border-gray-200 dark:border-[#333] opacity-60' }}">
                            {{ $seat->seat_number }}</div>
                    @endforeach
                </div>
            </div>

            <div class="mt-8 space-y-2">
                <div class="flex items-center gap-3 text-sm">
                    <div class="w-4 h-4 bg-blue-600 rounded"></div>
                    <span class="font-medium">Đã đặt ({{ count($occupiedSeatIds) }})</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    <div class="w-4 h-4 bg-white border border-gray-300 rounded"></div>
                    <span class="opacity-60">Còn trống ({{ count($seats) - count($occupiedSeatIds) }})</span>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white dark:bg-[#111111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <h2 class="text-xl font-bold mb-6">Thông tin vận hành</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="text-xs font-bold uppercase opacity-40 mb-2">{{ __('vehicles') }}</div>
                    <div class="text-lg font-bold">{{ $trip->vehicle->license_plate ?? 'N/A' }}</div>
                    <div class="text-sm opacity-60">{{ $trip->vehicle->type ?? '' }}</div>
                </div>
                <div>
                    <div class="text-xs font-bold uppercase opacity-40 mb-2">{{ __('drivers') }}</div>
                    <div class="text-lg font-bold">{{ $trip->driver->name ?? 'N/A' }}</div>
                    <div class="text-sm opacity-60">{{ $trip->driver->phone ?? '' }}</div>
                </div>
                <div>
                    <div class="text-xs font-bold uppercase opacity-40 mb-2">{{ __('cost') }}</div>
                    <div class="text-lg font-bold text-blue-600">{{ number_format($trip->price) }}đ</div>
                </div>
                <div>
                    <div class="text-xs font-bold uppercase opacity-40 mb-2">{{ __('status') }} chuyến</div>
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase">{{ $trip->status }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-[#111111] p-8 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <h2 class="text-xl font-bold mb-6">Danh sách Vé phát hành</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-xs uppercase opacity-40 font-bold">
                        <tr>
                            <th class="pb-4">{{ __('seats') }}</th>
                            <th class="pb-4">Mã Vé</th>
                            <th class="pb-4">Khách hàng</th>
                            <th class="pb-4">{{ __('status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#262626]">
                        @foreach($trip->tickets as $ticket)
                            <tr>
                                <td class="py-4 font-bold text-blue-600 text-lg">#{{ $ticket->seat->seat_number }}</td>
                                <td class="py-4 font-mono text-sm opacity-60">{{ $ticket->ticket_code }}</td>
                                <td class="py-4 font-medium">{{ $ticket->booking->contact_name }}</td>
                                <td class="py-4">
                                    @if($ticket->status === 'used')
                                        <span class="text-green-600 font-bold text-xs uppercase underline">Đã lên xe</span>
                                    @else
                                        <span class="text-orange-500 font-bold text-xs uppercase italic opacity-60">Chờ hành khách</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
