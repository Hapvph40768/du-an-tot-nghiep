@extends('layout.staff')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold mb-2">Bảng Tham Mưu Vận Hành</h1>
    <p class="text-gray-500 {{ isset($todayRevenue) ? '' : 'animate-pulse' }}">Dữ liệu Thời gian thực - Đồng bộ lúc {{ now()->format('H:i:s d/m/Y') }}</p>
</div>

<!-- Tầng 1: Highlight Metrics (Dòng Tiền & Quy Mô Ca Trực) -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-blue-600 to-indigo-600 rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
        <div class="absolute -right-4 -top-8 opacity-20 transform rotate-12">
            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" viewBox="0 0 16 16"><path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/></svg>
        </div>
        <div class="text-sm font-bold opacity-80 uppercase tracking-wider mb-2">Chuyến Hôm Nay</div>
        <div class="text-4xl font-black mb-1">{{ $todayTripCount }} <span class="text-lg font-medium opacity-60">Chuyến</span></div>
        <div class="text-xs opacity-80">Đã bán: {{ $todayBookingsCount }} đơn mới.</div>
    </div>

    <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl p-6 text-white shadow-lg">
        <div class="text-sm font-bold opacity-80 uppercase tracking-wider mb-2">Doanh thu Ca Số</div>
        <div class="text-4xl font-black mb-1">+{{ number_format($todayRevenue, 0, ',', '.') }}<span class="text-lg font-medium opacity-60">đ</span></div>
        <div class="text-xs opacity-80">Tiền ghi nhận qua hệ thống hôm nay.</div>
    </div>

    <div class="bg-white dark:bg-[#111] border border-red-200 dark:border-red-900/30 rounded-3xl p-6 shadow-sm">
        <div class="flex items-center gap-2 mb-2">
            <div class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></div>
            <div class="text-sm font-bold text-red-600 dark:text-red-400 uppercase tracking-wider">Đơn Treo Chưa Chốt</div>
        </div>
        <div class="text-4xl font-black text-red-600 dark:text-red-400 mb-1">{{ $pendingBookingsCount }}</div>
        <div class="text-xs opacity-60">Yêu cầu liên hệ khách chốt tiền mặt / hủy giữ chỗ.</div>
    </div>

    <div class="bg-white dark:bg-[#111] border border-gray-200 dark:border-[#262626] rounded-3xl p-6 shadow-sm flex flex-col justify-center gap-3">
        <div class="text-sm font-bold uppercase tracking-wider opacity-50 mb-1">Lối Tắt Nhanh</div>
        <a href="{{ route('staff.checkin.index') }}" class="w-full py-2.5 px-4 bg-gray-100 hover:bg-blue-600 hover:text-white dark:bg-gray-800 text-sm font-bold rounded-xl text-center transition-colors">🔍 Quét Check-in</a>
        <a href="{{ route('staff.parking.index') }}" class="w-full py-2.5 px-4 bg-gray-100 hover:bg-purple-600 hover:text-white dark:bg-gray-800 text-sm font-bold rounded-xl text-center transition-colors">🅿️ Quản lý Bãi Xe</a>
    </div>
</div>

<!-- Tầng 2: Work Board (Chia cột) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- CỘT TRÁI (2 part): Chuyến Sắp Chạy (Khẩn) & Đơn Hàng Treo -->
    <div class="lg:col-span-2 space-y-8">
        
        <!-- Khối 1: Lịch Trình Thực Tế -->
        <div class="bg-white dark:bg-[#111111] p-6 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <div class="flex justify-between items-center mb-6 pl-2 border-l-4 border-blue-500">
                <h2 class="text-xl font-bold">Chuyến Sắp Chạy (Today)</h2>
                <a href="{{ route('staff.trips.index') }}" class="text-sm font-bold text-blue-600 hover:underline">Tất cả chuyến &rarr;</a>
            </div>

            @if($upcomingTrips->isEmpty())
                <div class="p-8 text-center bg-gray-50 dark:bg-[#0a0a0a] rounded-2xl border border-dashed border-gray-300 dark:border-gray-800 text-gray-400">
                    Không có chuyến nào sắp khởi hành trong ngày.
                </div>
            @else
                <div class="space-y-4">
                    @foreach($upcomingTrips as $trip)
                        <div class="p-5 border {{ $trip->is_urgent ? 'border-red-300 bg-red-50 dark:bg-red-900/10 dark:border-red-800/50' : 'border-[#e3e3e0] dark:border-[#262626]' }} rounded-2xl hover:shadow-md transition-shadow relative overflow-hidden">
                            @if($trip->is_departed)
                                <div class="absolute top-0 right-0 px-4 py-1 bg-gray-200 text-gray-500 text-[10px] font-black rounded-bl-xl uppercase tracking-widest">Đã Khởi Hành</div>
                            @elseif($trip->is_urgent)
                                <div class="absolute top-0 right-0 px-4 py-1 bg-red-500 text-white text-[10px] font-black rounded-bl-xl uppercase tracking-widest animate-pulse">Chú ý: Khách Chưa Đến</div>
                            @endif

                            <div class="flex flex-col md:flex-row gap-4 mb-4">
                                <div class="shrink-0 w-24 text-center border-r border-[#e3e3e0] dark:border-[#262626] pr-4">
                                    <div class="text-2xl font-black text-blue-600 {{ $trip->is_urgent ? 'text-red-600' : '' }} mb-1">{{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}</div>
                                    <div class="text-[10px] font-bold opacity-40 uppercase">{{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }}</div>
                                </div>
                                <div class="grow">
                                    <div class="font-bold flex items-center gap-2 mb-1">
                                        {{ $trip->route->startLocation->name }} <span class="opacity-40">&rarr;</span> {{ $trip->route->endLocation->name }}
                                        <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-800 rounded text-xs opacity-60">{{ $trip->vehicle->license_plate ?? 'BKS' }}</span>
                                    </div>
                                    <div class="text-sm">
                                        <span class="opacity-60">Lấp đầy:</span> <span class="font-bold">{{ $trip->capacity_data['sold'] }}/{{ $trip->capacity_data['total'] }} ghế</span>
                                    </div>
                                </div>
                                <div class="shrink-0 text-right space-y-2">
                                    <a href="{{ route('staff.trips.show', $trip) }}" class="inline-block px-4 py-2 bg-gray-100 hover:bg-blue-100 text-blue-700 dark:bg-gray-800 font-bold rounded-xl text-xs transition-colors">Sơ đồ Vé</a>
                                </div>
                            </div>

                            <!-- Progress Bar for Check-in Status -->
                            <div class="mt-4 pt-4 border-t border-[#e3e3e0] dark:border-[#262626] border-dashed">
                                <div class="flex justify-between text-xs mb-1 font-bold">
                                    <span class="text-green-600">Lên xe: {{ $trip->capacity_data['checked_in'] }}</span>
                                    @if($trip->capacity_data['waiting'] > 0)
                                        <span class="text-red-500">Thiếu: {{ $trip->capacity_data['waiting'] }} khách</span>
                                    @endif
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-2 flex overflow-hidden">
                                    @if($trip->capacity_data['sold'] > 0)
                                        @php
                                            $checkedWidth = ($trip->capacity_data['checked_in'] / $trip->capacity_data['sold']) * 100;
                                            $waitingWidth = ($trip->capacity_data['waiting'] / $trip->capacity_data['sold']) * 100;
                                        @endphp
                                        <div class="bg-green-500 h-1.5" style="width: {{ $checkedWidth }}%"></div>
                                        <div class="bg-red-400 h-1.5 {{ $trip->is_urgent ? 'animate-pulse' : '' }}" style="width: {{ $waitingWidth }}%"></div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Khối 2: Đơn Treo Khẩn Cấp -->
        <div class="bg-white dark:bg-[#111111] p-6 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <div class="flex justify-between items-center mb-6 pl-2 border-l-4 border-red-500">
                <h2 class="text-xl font-bold">Việc Phải Giải Quyết Bằng Điện Thoại</h2>
                <a href="{{ route('staff.bookings.index') }}" class="text-sm font-bold text-blue-600 hover:underline">DS Đặt vé &rarr;</a>
            </div>

            @if($urgentBookings->isEmpty())
                <div class="p-6 text-center text-sm bg-green-50 dark:bg-green-900/10 text-green-600 rounded-2xl font-bold">
                    🎉 Tuyệt vời! Tất cả đơn trong ca đều đã thu tiền / Không có đơn bị treo sát giờ.
                </div>
            @else
                <div class="divide-y divide-gray-100 dark:divide-gray-800">
                    <div class="text-xs font-bold opacity-40 uppercase pb-2 mb-2 grid grid-cols-4 px-2">
                        <div class="col-span-2">Khách Hàng / ĐT</div>
                        <div>Chuyến (Giờ)</div>
                        <div class="text-right">Action</div>
                    </div>
                    @foreach($urgentBookings as $bk)
                        <div class="py-3 flex items-center justify-between px-2 hover:bg-gray-50 dark:hover:bg-gray-800/50 rounded-xl transition-colors group">
                            <div class="w-1/2">
                                <div class="font-bold flex items-center gap-2">
                                    {{ $bk->contact_name }}
                                </div>
                                <div class="text-sm opacity-60 text-blue-500">{{ $bk->contact_phone }}</div>
                            </div>
                            <div class="w-1/4">
                                <div class="text-sm font-medium">{{ \Carbon\Carbon::parse($bk->trip->trip_date)->format('d/m') }}</div>
                                <div class="text-xs opacity-60 font-bold font-mono">{{ $bk->trip->departure_time }}</div>
                            </div>
                            <div class="w-1/4 flex gap-2 justify-end opacity-0 group-hover:opacity-100 transition-opacity">
                                <form action="{{ route('staff.bookings.cancel', $bk) }}" method="POST" id="cancelForm{{$bk->id}}">
                                    @csrf
                                    <input type="hidden" name="cancellation_reason" id="cancellationReason{{$bk->id}}">
                                    <button type="button" class="px-3 py-1 bg-red-100 text-red-600 hover:bg-red-200 text-xs font-bold rounded-lg" onclick="let r = prompt('Vui lòng nhập lý do hủy đơn (bắt buộc):'); if(r){ document.getElementById('cancellationReason{{$bk->id}}').value = r; document.getElementById('cancelForm{{$bk->id}}').submit(); }">Hủy</button>
                                </form>
                                <a href="{{ route('staff.bookings.show', $bk) }}" class="px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 text-xs font-bold rounded-lg">Thu tiền</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    <!-- CỘT PHẢI: Live Logs & Notifications -->
    <div class="lg:col-span-1 space-y-8">
        <div class="bg-white dark:bg-[#111111] p-6 rounded-3xl shadow-sm border border-[#e3e3e0] dark:border-[#262626] h-full">
            <h2 class="text-xl font-bold mb-6 pl-2 border-l-4 border-gray-800 dark:border-gray-200">Live Feed - Ca Trực</h2>
            
            <div class="relative border-l border-gray-200 dark:border-gray-800 ml-3 space-y-6">
                @forelse($recentLogs as $log)
                    <div class="relative pl-6">
                        @php
                            $colorMap = [
                                'check_in' => 'bg-green-500',
                                'confirm_booking' => 'bg-blue-500',
                                'cancel_booking' => 'bg-red-500',
                                'mark_no_show' => 'bg-orange-500',
                                'parking_checkin' => 'bg-purple-500'
                            ];
                            $dotColor = $colorMap[$log->action] ?? 'bg-gray-400';
                        @endphp
                        <span class="absolute -left-[5px] top-1.5 w-2 h-2 {{ $dotColor }} rounded-full ring-4 ring-white dark:ring-[#111]"></span>
                        <div class="text-xs font-bold opacity-40 mb-1 flex items-center justify-between">
                            <span>{{ $log->user->name ?? 'Hệ thống' }}</span>
                            <span>{{ $log->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-sm font-medium leading-relaxed">
                            {!! strip_tags($log->description, '<b><strong>') !!}
                        </div>
                    </div>
                @empty
                    <div class="pl-6 text-sm opacity-50 italic text-center mt-10">Chưa có theo vết hành động nào trong hệ thống.</div>
                @endforelse
            </div>
            
        </div>
    </div>
</div>
@endsection
