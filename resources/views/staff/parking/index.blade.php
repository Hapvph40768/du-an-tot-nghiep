@extends('layout.staff')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold font-mono">Quản lý Bãi xe & Điều phối</h1>
    <div class="px-4 py-2 bg-blue-100 text-blue-700 rounded-xl text-xs font-bold uppercase tracking-widest animate-pulse">Trực tuyến</div>
</div>

<div class="space-y-12">
    @foreach($parkings as $parking)
        <div class="bg-white dark:bg-[#111111] p-8 rounded-[40px] shadow-sm border border-[#e3e3e0] dark:border-[#262626]">
            <div class="mb-8">
                <h2 class="text-3xl font-black mb-1 uppercase tracking-tighter">{{ $parking->name }}</h2>
                <p class="opacity-40 font-medium text-sm">{{ $parking->location }} - {{ $parking->description }}</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                @foreach($parking->slots as $slot)
                    <div class="aspect-square flex flex-col items-center justify-between p-4 rounded-3xl border-2 transition-all group
                        {{ $slot->status === 'occupied' 
                            ? 'bg-red-50 border-red-200 dark:bg-red-900/10 dark:border-red-800 shadow-lg shadow-red-500/10' 
                            : 'bg-green-50 border-green-200 dark:bg-green-900/10 dark:border-green-800' }}">
                        
                        <div class="text-[10px] uppercase font-black opacity-30 group-hover:opacity-100 transition-opacity">{{ $slot->slot_code }}</div>
                        
                        <div class="grow flex items-center justify-center">
                            @if($slot->status === 'occupied')
                                <div class="text-center">
                                    <div class="text-xs font-black text-red-600 dark:text-red-400 opacity-60 uppercase mb-1">{{ $slot->vehicle->license_plate ?? 'BKS' }}</div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-red-600 dark:text-red-400 mx-auto" viewBox="0 0 16 16"><path d="M4 10.707 5.293 12l5.707-5.707L9.707 5z"/><path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.07.165.16.322.27.466.12.156.257.3.411.432A.997.997 0 0 1 16 6.988V10.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 10.5V6.988a1 1 0 0 1 .359-.767c.154-.132.292-.276.411-.432a1.868 1.868 0 0 0 .27-.466zM4.82 3a1.5 1.5 0 0 0-1.379.91L2.65 5.748c-.052.12-.11.235-.173.344-.143.246-.312.467-.503.66a.5.5 0 0 0-.153.355V10.5a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5V7.107a.5.5 0 0 0-.153-.355 2.872 2.872 0 0 1-.503-.66c-.063-.109-.121-.224-.173-.344l-.791-1.838A1.5 1.5 0 0 0 11.182 3z"/></svg>
                                </div>
                            @else
                                <div class="text-xs font-black text-green-600 dark:text-green-400 uppercase tracking-widest opacity-40">TRỐNG</div>
                            @endif
                        </div>

                        <div class="mt-2 w-full">
                            @if($slot->status === 'occupied')
                                <form action="{{ route('staff.parking.checkout', $slot) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-1.5 bg-red-600 text-white rounded-xl text-[10px] font-black uppercase hover:bg-red-700 transition-colors">OUT</button>
                                </form>
                            @else
                                <form action="{{ route('staff.parking.checkin', $slot) }}" method="POST" class="flex gap-1">
                                    @csrf
                                    <input type="text" name="vehicle_id" placeholder="VID" required class="w-1/2 px-1 py-1 text-[10px] border border-green-200 dark:border-green-800 rounded-lg bg-green-50/50 dark:bg-transparent outline-none">
                                    <button type="submit" class="w-1/2 py-1.5 bg-green-600 text-white rounded-xl text-[10px] font-black uppercase hover:bg-green-700 transition-colors">IN</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
