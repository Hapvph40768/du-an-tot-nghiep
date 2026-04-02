@extends('layout.driver.DriverLayout')

@section('page-title', 'Lịch sử chuyến')

@section('content-main')
    <div class="max-w-7xl mx-auto px-4 py-8">

        @if ($trips->isEmpty())
            <div class="bg-white rounded-3xl p-16 text-center border border-gray-100 shadow-sm">
                <i class='bx bx-history text-7xl text-gray-200 mx-auto'></i>
                <p class="mt-6 text-xl text-gray-400">Không có chuyến xe nào trong lịch sử.</p>
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="trips-container">
                @foreach ($trips as $trip)
                    <div class="trip-card bg-white rounded-3xl overflow-hidden border border-gray-100 hover:border-gray-200 hover:shadow-xl transition-all duration-300 opacity-90">

                        <div class="h-1.5 {{ $trip->status === 'completed' ? 'bg-gradient-to-r from-emerald-500 to-teal-500' : 'bg-gradient-to-r from-gray-400 to-gray-500' }}"></div>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 text-gray-700 rounded-2xl text-sm font-semibold border border-gray-100">
                                        <i class='bx bx-time-five'></i>
                                        {{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}
                                    </span>
                                    <p class="text-xs text-gray-500 mt-2">
                                        {{ \Carbon\Carbon::parse($trip->trip_date)->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs text-gray-500">Biển số</span>
                                    <p class="font-semibold text-gray-800 mt-0.5">
                                        {{ $trip->vehicle->license_plate ?? 'Chưa gán' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 mb-8">
                                <div class="flex-1">
                                    <p class="font-bold text-lg text-gray-900 leading-tight">
                                        {{ $trip->route->departureLocation->name ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="text-gray-300 text-3xl -mt-2">
                                    <i class='bx bx-right-arrow-alt'></i>
                                </div>
                                <div class="flex-1 text-right">
                                    <p class="font-bold text-lg text-gray-900 leading-tight">
                                        {{ $trip->route->destinationLocation->name ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-6">
                                <span class="px-5 py-2 rounded-2xl text-xs font-bold uppercase tracking-wide
                                    {{ $trip->status === 'completed' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $trip->status === 'completed' ? 'Hoàn thành' : 'Đã hủy' }}
                                </span>
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('driver.trips.show', $trip) }}"
                                    class="flex-1 text-center py-3.5 border border-gray-200 text-gray-600 font-semibold rounded-2xl hover:bg-gray-50 transition">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $trips->links() }}
            </div>
        @endif
    </div>
@endsection
