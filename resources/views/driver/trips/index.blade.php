@extends('layout.driver.DriverLayout')

@section('page-title', 'Chuyến xe của tôi')

@section('content-main')
    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('driver.home') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 text-gray-500 hover:bg-amber-100 hover:text-amber-600 transition-colors">
                    <i class='bx bx-chevron-left text-2xl'></i>
                </a>
                <h2 class="text-2xl font-bold text-gray-800">{{{ __('trips') }} Sắp/Đang chạy</h2>
            </div>
            <a href="{{ route('driver.trips.history') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition flex items-center gap-2">
                <i class='bx bx-history'></i> Lịch sử chuyến đi
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-end">

                <div class="lg:col-span-7">
                    <label class="block text-sm font-medium text-gray-600 mb-3">Chọn ngày</label>
                    <div class="flex gap-2 overflow-x-auto pb-2 snap-x snap-mandatory scrollbar-hide" id="date-filter">
                        @for ($i = 0; $i < 7; $i++)
                            @php
                                $date = now()->addDays($i);
                            @endphp
                            <button onclick="applyFilters()" data-date="{{ $date->format('Y-m-d') }}"
                                class="date-btn flex-shrink-0 snap-center min-w-[74px] px-4 py-3.5 rounded-2xl font-medium transition-all text-center
                                        {{ $i === 0 ? 'bg-amber-500 text-white shadow-md ring-2 ring-amber-200' : 'bg-white border border-gray-200 hover:border-amber-300 hover:shadow text-gray-700' }}">
                                <div class="text-[10px] opacity-75 tracking-widest">{{ $date->format('D') }}}</div>
                                <div class="text-2xl font-semibold leading-none mt-0.5">{{ $date->format('d') }}}</div>
                                <div class="text-[10px] opacity-75 mt-1">{{ $date->format('m/Y') }}}</div>
                            </button>
                        @endfor
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <label class="block text-sm font-medium text-gray-600 mb-3">{{{ __('status') }}</label>
                    <div class="flex flex-wrap gap-2" id="status-filter">
                        <button onclick="applyFilters()" data-status="active"
                            class="status-btn flex-1 sm:flex-none px-5 py-3 rounded-2xl text-sm font-medium transition-all bg-amber-500 text-white shadow">
                            Sắp chạy
                        </button>
                        <button onclick="applyFilters()" data-status="running"
                            class="status-btn flex-1 sm:flex-none px-5 py-3 rounded-2xl text-sm font-medium transition-all border border-gray-200 hover:border-emerald-300">
                            Đang chạy
                        </button>
                    </div>
                </div>

            </div>
        </div>

        @if ($trips->isEmpty())
            <div class="bg-white rounded-3xl p-16 text-center">
                <i class='bx bx-bus text-7xl text-gray-200 mx-auto'></i>
                <p class="mt-6 text-xl text-gray-400">Không có chuyến xe nào phù hợp với bộ lọc</p>
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="trips-container">
                @foreach ($trips as $trip)
                    <div class="trip-card bg-white rounded-3xl overflow-hidden border border-gray-100 hover:border-amber-200 hover:shadow-xl transition-all duration-300"
                        data-date="{{ \Carbon\Carbon::parse($trip->trip_date)->format('Y-m-d') }}"
                        data-status="{{ $trip->status }}"
                        data-departure="{{ \Carbon\Carbon::parse($trip->trip_date . ' ' . $trip->departure_time)->format('Y-m-d H:i:s') }}">

                        <div class="h-1.5 bg-gradient-to-r from-amber-500 via-orange-500 to-red-500"></div>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <span
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 text-amber-700 rounded-2xl text-sm font-semibold">
                                        <i class='bx bx-time-five'></i>
                                        {{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}}</span>
                                    <p class="text-xs text-gray-500 mt-2">
                                        {{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }}}</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs text-gray-500">Biển số</span>
                                    <p class="font-semibold text-gray-800 mt-0.5">
                                        {{ $trip->vehicle->license_plate ?? 'Chưa gán' }}}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 mb-8">
                                <div class="flex-1">
                                    <p class="font-bold text-xl text-gray-900 leading-tight">
                                        {{ $trip->route->departureLocation->name ?? 'N/A' }}}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{{ __('departure') }}</p>
                                </div>
                                <div class="text-amber-500 text-5xl -mt-2">
                                    <i class='bx bx-right-arrow-alt'></i>
                                </div>
                                <div class="flex-1 text-right">
                                    <p class="font-bold text-xl text-gray-900 leading-tight">
                                        {{ $trip->route->destinationLocation->name ?? 'N/A' }}}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{{ __('destination') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-3xl font-semibold text-emerald-600">
                                        {{ $trip->tickets->where('status', '!=', 'cancelled')->count() }}}</span>
                                    <span class="text-gray-400 text-lg">/</span>
                                    <span class="text-gray-500">{{ $trip->vehicle->total_seats ?? '?' }}}</span>
                                    <span class="text-xs text-gray-400 ml-1">ghế</span>
                                </div>

                                <span
                                    class="px-5 py-1.5 rounded-2xl text-xs font-semibold
                                    {{ $trip->status === 'active'
                                        ? 'bg-blue-100 text-blue-700'
                                        : ($trip->status === 'running'
                                            ? 'bg-emerald-100 text-emerald-700'
                                            : ($trip->status === 'completed'
                                                ? 'bg-gray-100 text-gray-700'
                                                : ($trip->status === 'broken'
                                                    ? 'bg-red-100 text-red-700'
                                                    : 'bg-red-100 text-red-700'))) }}">
                                    {{ match ($trip->status) {
                                        'active' => 'Sắp chạy',
                                        'running' => 'Đang chạy',
                                        'broken' => 'Hỏng / Gián đoạn',
                                        'completed' => 'Hoàn thành',
                                        'canceled' => 'Đã hủy',
                                        default => ucfirst($trip->status),
                                    }}}}</span>
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('driver.trips.show', $trip) }}"
                                    class="flex-1 text-center py-3.5 border border-amber-500 text-amber-600 font-semibold rounded-2xl hover:bg-amber-50 transition">
                                    Xem chi tiết
                                </a>

                                @if ($trip->status === 'active')
                                    <form action="{{ route('driver.trips.updateStatus', $trip) }}" method="POST" class="flex-1" style="display:flex">
                                        @csrf
                                        <input type="hidden" name="status" value="running">
                                        <button type="submit"
                                            onclick="return confirm('Xác nhận bắt đầu chuyến này?')"
                                            class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-2xl transition-all active:scale-[0.97]">
                                            Bắt đầu chuyến
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $trips->links() }}}</div>
        @endif
    </div>

    <script>
        function applyFilters() {
            const selectedDate = document.querySelector('.date-btn.bg-amber-500')?.getAttribute('data-date') || '';
            let selectedStatus = document.querySelector('.status-btn.bg-amber-500')?.getAttribute('data-status') ||
            'active';

            const now = new Date();
            const tenHoursLater = new Date(now.getTime() + 10 * 60 * 60 * 1000);

            const tripCards = document.querySelectorAll('.trip-card');
            let visibleCount = 0;

            tripCards.forEach(card => {
                const cardDate = card.getAttribute('data-date');
                const cardStatus = card.getAttribute('data-status');
                const departureStr = card.getAttribute('data-departure');
                const departureTime = new Date(departureStr);

                const matchDate = !selectedDate || cardDate === selectedDate;
                const matchStatus = cardStatus === selectedStatus;

                let matchTime = true;
                if (selectedStatus === 'active') {
                    matchTime = departureTime >= now && departureTime <= tenHoursLater;
                }} const shouldShow = matchDate && matchStatus && matchTime;
                card.style.display = shouldShow ? 'block' : 'none';

                if (shouldShow) visibleCount++;
            });

            const emptyDiv = document.querySelector('.bg-white.rounded-3xl.p-16');
            if (emptyDiv) {
                emptyDiv.style.display = (visibleCount === 0) ? 'block' : 'none';
            }}} document.querySelectorAll('.date-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.date-btn').forEach(b => {
                    b.classList.remove('bg-amber-500', 'text-white', 'shadow-md', 'ring-2',
                        'ring-amber-200');
                    b.classList.add('bg-white', 'border-gray-200', 'text-gray-700');
                });
                this.classList.add('bg-amber-500', 'text-white', 'shadow-md', 'ring-2', 'ring-amber-200');
                this.classList.remove('bg-white', 'border-gray-200', 'text-gray-700');
                applyFilters();
            });
        });

        document.querySelectorAll('.status-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.status-btn').forEach(b => {
                    b.classList.remove('bg-amber-500', 'text-white', 'shadow-md');
                    b.classList.add('border', 'border-gray-200');
                });
                this.classList.add('bg-amber-500', 'text-white', 'shadow-md');
                this.classList.remove('border', 'border-gray-200');
                applyFilters();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const todayBtn = document.querySelector(`.date-btn[data-date="{{ now()->format('Y-m-d') }}"]`);
            if (todayBtn) {
                todayBtn.classList.add('bg-amber-500', 'text-white', 'shadow-md', 'ring-2', 'ring-amber-200');
            }} const activeBtn = document.querySelector('.status-btn[data-status="active"]');
            if (activeBtn) {
                activeBtn.classList.add('bg-amber-500', 'text-white', 'shadow-md');
            }} applyFilters();
        });
    </script>
@endsection
