@extends('layout.driver.DriverLayout')

@section('page-title', 'Chi tiết chuyến xe')

@section('content-main')
    <div class="max-w-6xl mx-auto px-4 py-10">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
            <div class="flex items-center gap-4">
                <a href="{{ route('driver.trips.index') }}"
                    class="flex items-center gap-2 text-gray-500 hover:text-amber-600 transition-colors">
                    <i class='bx bx-chevron-left text-3xl'></i>
                    <span class="font-medium text-lg">Quay lại</span>
                </a>
            </div>

            <span
                class="px-6 py-2.5 rounded-3xl text-sm font-semibold shadow-sm
                {{ $trip->status === 'active'
                    ? 'bg-blue-100 text-blue-700'
                    : ($trip->status === 'in_progress'
                        ? 'bg-emerald-100 text-emerald-700'
                        : ($trip->status === 'completed'
                            ? 'bg-gray-100 text-gray-700'
                            : 'bg-red-100 text-red-700')) }}">
                {{ $trip->status === 'active' ? 'Sắp chạy' : ucfirst($trip->status) }}
            </span>
        </div>

        <div class="grid lg:grid-cols-12 gap-8">

            <div class="lg:col-span-8 space-y-8">

                <div class="bg-white rounded-3xl shadow border border-gray-100 overflow-hidden">
                    <div class="h-2 bg-gradient-to-r from-amber-500 to-orange-500"></div>
                    <div class="p-8">
                        <div class="flex justify-between items-start">
                            <div>
                                <span
                                    class="inline-flex items-center gap-3 px-6 py-3 bg-amber-50 text-amber-700 rounded-3xl text-xl font-semibold">
                                    <i class='bx bx-time-five'></i>
                                    {{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}
                                </span>
                                <p class="mt-3 text-gray-500 ml-6">
                                    {{ \Carbon\Carbon::parse($trip->departure_time)->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs uppercase tracking-widest text-gray-400">Biển số</p>
                                <p class="text-3xl font-bold text-gray-900 mt-1">
                                    {{ $trip->vehicle->license_plate ?? 'Chưa gán' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-12 flex items-center gap-8">
                            <div class="flex-1 text-center">
                                <p class="text-3xl font-bold text-gray-900 leading-tight">
                                    {{ $trip->route->departureLocation->name ?? 'N/A' }}
                                </p>
                                <p class="text-sm text-gray-500 mt-2">Điểm khởi hành</p>
                            </div>

                            <div class="flex flex-col items-center text-amber-500">
                                <i class='bx bx-right-arrow-alt text-6xl'></i>
                                <div class="w-24 h-px bg-gradient-to-r from-transparent via-amber-400 to-transparent my-2">
                                </div>
                            </div>

                            <div class="flex-1 text-center">
                                <p class="text-3xl font-bold text-gray-900 leading-tight">
                                    {{ $trip->route->destinationLocation->name ?? 'N/A' }}
                                </p>
                                <p class="text-sm text-gray-500 mt-2">Điểm đến</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-14">
                            <div class="bg-gray-50 rounded-2xl p-6">
                                <p class="text-gray-500 text-sm">Khởi hành</p>
                                <p class="text-xl font-semibold mt-2">
                                    {{ \Carbon\Carbon::parse($trip->trip_date . ' ' . $trip->departure_time)->format('H:i • d/m/Y') }}
                                </p>
                            </div>
                            <div class="bg-gray-50 rounded-2xl p-6">
                                <p class="text-gray-500 text-sm">Dự kiến đến nơi</p>
                                <p class="text-xl font-semibold mt-2">
                                    @php $duration = $trip->route->duration_minutes ?? 300; @endphp
                                    {{ \Carbon\Carbon::parse($trip->trip_date . ' ' . $trip->departure_time)->addMinutes($duration)->format('H:i • d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow border border-gray-100 p-8">
                    <h2 class="flex items-center gap-3 text-xl font-semibold mb-6">
                        <i class='bx bx-bus text-2xl text-amber-500'></i>
                        Thông tin phương tiện
                    </h2>
                    <div class="grid grid-cols-2 gap-x-12 gap-y-8">
                        <div>
                            <p class="text-gray-500">Loại xe</p>
                            <p class="font-semibold text-lg mt-1">{{ $trip->vehicle->type ?? 'Không xác định' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Tổng số ghế</p>
                            <p class="font-semibold text-lg mt-1">{{ $trip->vehicle->total_seats ?? '?' }} ghế</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Biển số xe</p>
                            <p class="font-semibold text-lg mt-1">{{ $trip->vehicle->license_plate ?? 'Chưa gán xe' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Trạng thái xe</p>
                            <p class="font-semibold text-emerald-600 text-lg mt-1">Sẵn sàng hoạt động</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow border border-gray-100 p-8">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-xl font-semibold">Danh sách hành khách</h2>
                        <div class="text-sm">
                            <span class="font-semibold text-emerald-600">
                                {{ $trip->tickets->where('status', '!=', 'cancelled')->count() }}
                            </span>
                            <span class="text-gray-400"> / {{ $trip->vehicle->total_seats ?? '?' }} ghế</span>
                        </div>
                    </div>

                    @if ($trip->tickets->where('status', '!=', 'cancelled')->isEmpty())
                        <div class="text-center py-16 text-gray-400">
                            <i class='bx bx-user-x text-6xl mx-auto'></i>
                            <p class="mt-4">Chưa có hành khách nào đặt vé cho chuyến này.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-5 font-medium text-gray-500">Họ và tên</th>
                                        <th class="text-left py-5 font-medium text-gray-500">Số ghế</th>
                                        <th class="text-left py-5 font-medium text-gray-500">Số điện thoại</th>
                                        <th class="text-center py-5 font-medium text-gray-500">Mã vé</th>
                                        <th class="text-center py-5 font-medium text-gray-500">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($trip->tickets->where('status', '!=', 'cancelled') as $ticket)
                                        @php
                                            $user = $ticket->booking?->user ?? null;
                                        @endphp
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="py-5 font-medium">
                                                {{ $ticket->passenger_name ?? ($user?->name ?? 'Khách vãng lai') }}
                                            </td>
                                            <td class="py-5 font-semibold text-amber-600">
                                                {{ $ticket->seat?->seat_number ?? ($ticket->seat_number ?? '—') }}
                                            </td>
                                            <td class="py-5 text-gray-600">
                                                {{ $user?->phone ?? '—' }}
                                            </td>
                                            <td class="py-5 text-center font-mono text-sm">
                                                {{ $ticket->ticket_code }}
                                            </td>
                                            <td class="py-5 text-center">
                                                <span
                                                    class="px-5 py-1.5 text-xs font-medium rounded-3xl
                                                    {{ $ticket->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                                    {{ ucfirst($ticket->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">

                <!-- Trạng thái + Hành động -->
                <div class="bg-white rounded-3xl shadow border border-gray-100 p-8 sticky top-8">
                    <h3 class="font-semibold text-lg mb-6">Trạng thái chuyến đi</h3>

                    @if ($trip->status === 'active')
                        <div
                            class="bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-100 rounded-3xl p-7 text-center mb-8">
                            <p class="text-amber-700 font-medium">Thời gian còn lại</p>
                            <p id="countdown" class="text-5xl font-bold text-amber-600 mt-3 tracking-tighter">—</p>
                            <p class="text-sm text-amber-600 mt-1">trước khi khởi hành</p>
                        </div>
                    @endif

                    <div class="space-y-4">
                        @if ($trip->status === 'active')
                            <form action="{{ route('driver.trips.updateStatus', $trip) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="running">
                                <button type="submit" onclick="return confirm('Xác nhận bắt đầu chuyến này?')" 
                                    class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-2xl transition-all active:scale-95 flex items-center justify-center gap-2">
                                    <i class='bx bx-play-circle text-xl'></i> Bắt đầu chuyến
                                </button>
                            </form>
                        @elseif ($trip->status === 'running')
                            <form action="{{ route('driver.trips.updateStatus', $trip) }}" method="POST" class="mb-3">
                                @csrf
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" onclick="return confirm('Xác nhận đã Hoàn Thành chuyến đi?')" 
                                    class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-2xl transition-all active:scale-95 flex items-center justify-center gap-2">
                                    <i class='bx bx-check-circle text-xl'></i> Hoàn thành chuyến
                                </button>
                            </form>
                            <form action="{{ route('driver.trips.updateStatus', $trip) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="broken">
                                <button type="submit" onclick="return confirm('Xác nhận báo Sự Cố/Hỏng xe? Admin sẽ nhận được thông báo giải quyết.')" 
                                    class="w-full py-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl transition-all active:scale-95 flex items-center justify-center gap-2">
                                    <i class='bx bx-error-circle text-xl'></i> Báo sự cố/Xe hỏng
                                </button>
                            </form>
                        @endif

                        <button onclick="showRouteModal()"
                            class="w-full mt-4 py-4 border border-amber-500 text-amber-600 font-semibold rounded-2xl hover:bg-amber-50 transition flex items-center justify-center gap-2">
                            <i class='bx bx-map-alt text-xl'></i>
                            Thứ tự điểm đón
                        </button>
                        
                        <a href="#" onclick="openFullGoogleMapsRoute(); return false;"
                            class="w-full mt-3 py-4 border border-blue-500 text-blue-600 font-semibold rounded-2xl hover:bg-blue-50 transition flex items-center justify-center gap-2">
                            <i class='bx bx-directions text-xl'></i> Xem Hướng dẫn đường đi (Google Maps)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="routeModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white rounded-3xl max-w-xl w-full mx-4 shadow-2xl overflow-hidden">

            <div class="px-8 py-7 border-b flex items-center justify-between bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center">
                        <i class='bx bx-map-alt text-2xl'></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900">Lộ trình chuyến đi</h3>
                        <p class="text-sm text-gray-500">Các điểm dừng đón khách theo thứ tự</p>
                    </div>
                </div>
                <button onclick="closeRouteModal()"
                    class="w-10 h-10 flex items-center justify-center text-3xl text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-2xl transition">
                    ×
                </button>
            </div>

            <div class="p-8 overflow-y-auto" style="max-height: calc(85vh - 180px)">
                <div class="relative pl-12 space-y-12">

                    @forelse ($trip->pickupPoints->sortBy('pivot.order') as $index => $point)
                        <div class="relative flex gap-6 group">
                            <div class="absolute -left-12 top-3 flex flex-col items-center">
                                <div
                                    class="w-7 h-7 rounded-full bg-amber-500 flex items-center justify-center text-white text-sm font-bold shadow-md">
                                    {{ $index + 1 }}
                                </div>
                                @if (!$loop->last)
                                    <div
                                        class="w-px h-[calc(100%+48px)] bg-gradient-to-b from-amber-300 to-transparent mt-3">
                                    </div>
                                @endif
                            </div>

                            <div
                                class="flex-1 bg-white border border-gray-100 rounded-3xl p-6 hover:border-amber-300 hover:shadow-md transition-all">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="font-semibold text-xl text-gray-900">{{ $point->name }}</p>

                                        @if ($point->address)
                                            <p class="text-gray-600 mt-2 leading-relaxed">{{ $point->address }}</p>
                                        @endif

                                        @if ($point->location)
                                            <p class="text-xs text-gray-400 mt-3 flex items-center gap-1">
                                                <i class='bx bx-map-pin'></i> {{ $point->location->name }}
                                            </p>
                                        @endif
                                    </div>

                                    <button
                                        onclick="openGoogleMaps('{{ addslashes($point->name) }}', '{{ addslashes($point->address ?? '') }}')"
                                        class="flex-shrink-0 flex items-center gap-3 bg-white border-2 border-blue-500 hover:bg-blue-50 hover:border-blue-600 text-blue-600 px-6 py-4 rounded-2xl font-medium transition-all active:scale-95">
                                        <span class="text-xl">
                                            <i class="fa-solid fa-location-arrow"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20">
                            <div class="mx-auto w-20 h-20 bg-gray-100 rounded-3xl flex items-center justify-center">
                                <i class='bx bx-map text-5xl text-gray-300'></i>
                            </div>
                            <p class="mt-6 text-gray-400 text-lg">Chuyến này chưa có điểm đón nào được thiết lập.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="px-8 py-6 border-t bg-gray-50 flex justify-end rounded-b-3xl">
                <button onclick="closeRouteModal()"
                    class="px-10 py-3.5 bg-white border border-gray-300 hover:border-gray-400 font-medium rounded-2xl transition text-gray-700">
                    Đóng
                </button>
            </div>
        </div>
    </div>

    @if ($trip->status === 'active')
        <script>
            function startCountdown() {
                const departure = new Date(
                    "{{ \Carbon\Carbon::parse($trip->trip_date . ' ' . $trip->departure_time)->format('Y-m-d H:i:s') }}");
                const el = document.getElementById('countdown');

                const interval = setInterval(() => {
                    const diff = departure - new Date();
                    if (diff <= 0) {
                        el.textContent = "Đã đến giờ";
                        clearInterval(interval);
                        return;
                    }
                    const hours = Math.floor(diff / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    el.textContent = `${hours}h ${minutes}m`;
                }, 1000);
            }
            document.addEventListener('DOMContentLoaded', startCountdown);
        </script>
    @endif

    <script>
        function showRouteModal() {
            const modal = document.getElementById('routeModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeRouteModal() {
            const modal = document.getElementById('routeModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openGoogleMaps(name, address) {
            let query = address ? address : name;
            const encodedQuery = encodeURIComponent(query.trim());

            const googleMapsUrl = `https://www.google.com/maps/search/?api=1&query=${encodedQuery}`;

            window.open(googleMapsUrl, '_blank');
        }

        function openFullGoogleMapsRoute() {
            @php
                $origin = $trip->route->departureLocation->name ?? '';
                $destination = $trip->route->destinationLocation->name ?? '';
                $waypoints = $trip->pickupPoints->sortBy('pivot.order')->pluck('name')->join('|');
            @endphp
            const origin = encodeURIComponent("{{ $origin }}");
            const dest = encodeURIComponent("{{ $destination }}");
            const waypoints = encodeURIComponent("{{ $waypoints }}");
            
            const url = `https://www.google.com/maps/dir/?api=1&origin=${origin}&destination=${dest}&waypoints=${waypoints}`;
            window.open(url, '_blank');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") closeRouteModal();
        });

        document.getElementById('routeModal').addEventListener('click', function(e) {
            if (e.target === this) closeRouteModal();
        });
    </script>
@endsection
