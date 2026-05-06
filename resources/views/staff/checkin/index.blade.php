@extends('layout.staff')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold">Điều phối Check-in</h1>
        <p class="text-gray-500 italic">Theo dõi luồng khách: Tuyến đường &rarr; Chuyến xe &rarr; Hành khách.</p>
    </div>
    <div class="flex gap-2">
        @if(request('trip_id'))
            <a href="{{ route('staff.checkin.index', ['route_id' => request('route_id')]) }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
                &lsaquo; Đổi xe khác
            </a>
        @endif
        @if(request('route_id'))
            <a href="{{ route('staff.checkin.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
                &laquo; Chọn Tuyến khác
            </a>
        @endif
    </div>
</div>

<!-- TÌM KIẾM NHANH (Luôn hiển thị) -->
<div class="bg-white dark:bg-[#111111] p-4 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626] mb-8">
    <form action="{{ route('staff.checkin.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
        @if(request('route_id')) <input type="hidden" name="route_id" value="{{ request('route_id') }}"> @endif
        @if(request('trip_id')) <input type="hidden" name="trip_id" value="{{ request('trip_id') }}"> @endif
        <div class="grow">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm nhanh SĐT / Mã vé bất kỳ..." class="w-full px-4 py-2 bg-gray-50 dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#262626] rounded-xl font-bold outline-none focus:ring-2 focus:ring-blue-500 transition-all">
        </div>
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-md transition-all">Tìm nhanh</button>
        @if(request('search') || request('route_id') || request('trip_id'))
            <a href="{{ route('staff.checkin.index') }}" class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl font-bold flex items-center justify-center italic text-xs">Xóa lọc</a>
        @endif
    </form>
</div>

@if(!request('route_id') && !request('search'))
    <!-- BƯỚC 1: CHỌN TUYẾN ĐƯỜNG -->
    <div class="mb-6">
        <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
            <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
            Bước 1: Chọn Tuyến đường vận hành
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($routes as $route)
                <a href="{{ route('staff.checkin.index', ['route_id' => $route->id]) }}" class="bg-white dark:bg-[#111111] p-6 rounded-3xl border-2 border-transparent hover:border-blue-500 shadow-sm transition-all group">
                    <div class="text-[10px] font-black opacity-30 uppercase mb-2">Chuyến đi</div>
                    <div class="text-lg font-black leading-tight group-hover:text-blue-600 transition-colors">
                        {{ $route->startLocation->name }} <br>
                        <span class="text-blue-500">&rarr;</span> {{ $route->endLocation->name }}
                    </div>
                </a>
            @empty
                <div class="col-span-full py-20 text-center opacity-40 italic font-bold">Hiện không có tuyến đường nào có lịch trình sắp tới.</div>
            @endforelse
        </div>
    </div>

@elseif(request('route_id') && !request('trip_id') && !request('search'))
    <!-- BƯỚC 2: CHỌN XE / CHUYẾN CỤ THỂ -->
    <div class="mb-6">
        <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
            <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
            Bước 2: Chọn xe đang làm lệnh ({{ $selectedRoute->startLocation->name }} &rarr; {{ $selectedRoute->endLocation->name }})
        </h2>

        @php
            $statusLabels = [
                'departing' => ['label' => 'ĐANG KHỞI HÀNH', 'color' => 'bg-red-500', 'bg' => 'bg-red-50 dark:bg-red-950/20'],
                'ready' => ['label' => 'CHUẨN BỊ CHẠY', 'color' => 'bg-orange-500', 'bg' => 'bg-orange-50 dark:bg-orange-950/20'],
                'upcoming' => ['label' => 'SẮP TỚI', 'color' => 'bg-blue-500', 'bg' => 'bg-gray-50 dark:bg-gray-900/40'],
                'departed' => ['label' => 'ĐÃ KHỞI HÀNH', 'color' => 'bg-gray-500', 'bg' => 'bg-gray-100 dark:bg-gray-800/40']
            ];
        @endphp

        <div class="space-y-8">
            @foreach(['departing', 'ready', 'upcoming', 'departed'] as $status)
                @php $filteredTrips = $trips->where('operational_status', $status); @endphp
                @if($filteredTrips->count() > 0)
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <span class="px-3 py-1 {{ $statusLabels[$status]['color'] }} text-white text-[10px] font-black rounded-lg">{{ $statusLabels[$status]['label'] }}</span>
                            <div class="grow h-px bg-gray-100 dark:bg-gray-800"></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($filteredTrips as $trip)
                                <div class="{{ $statusLabels[$status]['bg'] }} p-6 rounded-3xl border border-transparent hover:border-current transition-all group">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="text-2xl font-black">{{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}</div>
                                        <div class="text-xs font-bold opacity-60 uppercase">{{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m') }}</div>
                                    </div>
                                    <div class="mb-6">
                                        <div class="text-sm font-bold">{{ $trip->vehicle->license_plate ?? 'BKS-???' }}</div>
                                        <div class="text-xs opacity-60 italic">{{ $trip->driver->name ?? 'Chưa gán tài xế' }}</div>
                                    </div>
                                    <a href="{{ route('staff.checkin.index', ['route_id' => request('route_id'), 'trip_id' => $trip->id]) }}" class="w-full py-3 bg-white dark:bg-black rounded-2xl text-center text-sm font-black shadow-sm group-hover:shadow-lg transition-all block">
                                        VÀO ĐIỂM DANH &rarr;
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

@else
    <!-- BƯỚC 3: DANH SÁCH HÀNH KHÁCH -->
    @if(request('trip_id') && !request('search'))
        <div class="mb-6 p-4 bg-blue-600 text-white rounded-2xl shadow-lg flex items-center justify-between">
            <div>
                <div class="text-[10px] font-black opacity-60 uppercase">Đang check-in xe</div>
                <div class="text-lg font-black">{{ $tickets->first()?->trip?->vehicle?->license_plate ?? '???' }} | Chuyến {{ $tickets->first()?->trip?->departure_time ?? '--:--' }}</div>
            </div>
            <div class="text-right">
                <div class="text-[10px] font-black opacity-60 uppercase">Tổng khách</div>
                <div class="text-2xl font-black">{{ $tickets->total() }}</div>
            </div>
        </div>
    @endif

    <div class="flex flex-wrap gap-2 mb-6">
        @php
            $statusTabs = ['' => 'Tất cả', 'pending' => 'Chưa lên', 'used' => 'Đã lên', 'no_show' => 'Vắng'];
        @endphp
        @foreach($statusTabs as $val => $label)
            <a href="{{ request()->fullUrlWithQuery(['status' => $val]) }}" 
               class="px-5 py-2.5 rounded-xl text-xs font-black transition-all {{ (request('status', '') == (string)$val) ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-white dark:bg-[#111] border border-[#e3e3e0] dark:border-[#262626]' }}">
                {{ $tab['label'] ?? $label }}
            </a>
        @endforeach
    </div>

    <div class="bg-white dark:bg-[#111111] rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626] overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 dark:bg-[#1a1a1a] text-[10px] uppercase opacity-40 font-black tracking-widest border-b border-[#e3e3e0] dark:border-[#262626]">
                <tr>
                    <th class="px-6 py-4">Ghế</th>
                    <th class="px-6 py-4">Khách hàng</th>
                    <th class="px-6 py-4">Trạng thái</th>
                    <th class="px-6 py-4 text-center">Xử lý</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#262626]">
                @forelse($tickets as $ticket)
                    <tr class="hover:bg-gray-50 dark:hover:bg-[#161616] transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-xl font-black text-blue-600">{{ $ticket->seat?->seat_number ?? '?' }}</div>
                            <div class="text-[10px] font-mono opacity-40">{{ $ticket->ticket_code }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold">{{ $ticket->booking?->contact_name ?? 'N/A' }}</div>
                            <div class="text-xs text-blue-500 font-bold">{{ $ticket->booking?->contact_phone ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($ticket->status === 'used')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-[10px] font-black uppercase italic">ĐÃ LÊN XE</span>
                            @elseif($ticket->status === 'no_show')
                                <span class="px-3 py-1 bg-red-100 text-red-600 rounded-lg text-[10px] font-black uppercase italic">VẮNG MẶT</span>
                            @elseif($ticket->booking?->status !== 'paid')
                                <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-[10px] font-black uppercase animate-pulse">CHƯA TRẢ TIỀN</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg text-[10px] font-black uppercase">CHỜ ĐẾN</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                @if(in_array($ticket->status, ['used', 'no_show']))
                                    <form action="{{ route('staff.checkin.reset', $ticket) }}" method="POST">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Hoàn tác trạng thái vé này?')" class="text-[10px] text-orange-500 font-bold italic py-2 hover:underline">Hoàn tác</button>
                                    </form>
                                @elseif($ticket->booking?->status === 'paid')
                                    <form action="{{ route('staff.checkin.process', $ticket) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-xl text-xs font-black shadow-md hover:scale-105 transition-all">LÊN XE</button>
                                    </form>
                                    <button type="button" 
                                            onclick="openNoShowModal('{{ $ticket->booking?->contact_name }}', '{{ $ticket->booking?->contact_phone }}', '{{ route('staff.checkin.noshow', $ticket) }}')" 
                                            class="px-4 py-2 bg-red-50 text-red-600 rounded-xl text-xs font-bold hover:bg-red-100 italic transition-all">
                                        Vắng
                                    </button>
                                @else
                                    <form action="{{ route('staff.bookings.confirm', $ticket->booking) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-black shadow-md hover:scale-105 transition-all">THU TIỀN</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-20 text-center opacity-40 italic">Không có dữ liệu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-8">
        {{ $tickets->links() }}
    </div>
@endif

<!-- Shared Modal (No-Show Verification) -->
<div id="noShowModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-[#111] w-full max-w-md rounded-3xl shadow-2xl p-8 text-center animate-in zoom-in-95 duration-200">
        <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/></svg>
        </div>
        <h3 class="text-xl font-black mb-2 uppercase">GỌI ĐIỆN XÁC MINH</h3>
        <p class="text-[11px] text-gray-500 mb-6 italic">Hãy gọi xác nhận 2-3 lần trước khi đánh dấu vắng.</p>
        
        <div class="bg-gray-50 dark:bg-[#0a0a0a] border border-gray-100 dark:border-[#222] p-6 rounded-2xl mb-6">
            <div id="modalCustomerName" class="text-lg font-bold mb-3">...</div>
            <a id="modalCustomerPhone" href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-xl font-black shadow-lg hover:scale-105 transition-all text-sm uppercase italic">
                BẮM ĐỂ GỌI NGAY
            </a>
        </div>

        <div class="flex gap-4">
            <button onclick="closeNoShowModal()" class="w-1/2 py-4 font-bold text-gray-400">Bỏ qua</button>
            <form id="noShowForm" action="#" method="POST" class="w-1/2">
                @csrf
                <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-black active:scale-95 transition-all">CHỐT VẮNG</button>
            </form>
        </div>
    </div>
</div>

<script>
function openNoShowModal(name, phone, actionUrl) {
    document.getElementById('modalCustomerName').innerText = name;
    document.getElementById('modalCustomerPhone').href = 'tel:' + phone;
    document.getElementById('noShowForm').action = actionUrl;
    document.getElementById('noShowModal').classList.remove('hidden');
}
function closeNoShowModal() {
    document.getElementById('noShowModal').classList.add('hidden');
}
</script>
@endsection
