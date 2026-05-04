@extends('layout.admin')

@section('header-title', 'Quản lý Đội xe')
@section('header-subtitle', 'Theo dõi và điều phối tài xế hệ thống')

@section('content-main')
<div class="space-y-8" x-data="{ status: '{{ request('status', '') }}' }">
    <!-- Header Actions -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex flex-wrap items-center gap-4 flex-1">
            <form action="{{ route('admin.drivers.index') }}" method="GET" class="contents">
                <div class="relative group w-full md:w-80">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-white/20 group-focus-within:text-brand-accent transition-colors"></i>
                    <input type="text" name="keyword" value="{{ request('keyword') }}" 
                           placeholder="Tìm tên, SĐT, bằng lái..." 
                           class="w-full bg-white/5 border border-white/5 focus:border-brand-accent/30 focus:outline-none rounded-2xl pl-12 pr-4 py-3 text-sm transition-all focus:ring-1 focus:ring-brand-accent/20">
                </div>
                
                <div class="relative group min-w-[180px]">
                    <select name="status" x-model="status" @change="$el.form.submit()" 
                            class="w-full appearance-none bg-white/5 border border-white/5 focus:border-brand-accent/30 focus:outline-none rounded-2xl px-5 py-3 text-sm transition-all cursor-pointer">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active">Đang hoạt động</option>
                        <option value="busy">Đang chạy</option>
                        <option value="inactive">Đã nghỉ</option>
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-white/20 pointer-events-none"></i>
                </div>
            </form>
        </div>

        <a href="{{ route('admin.drivers.create') }}" class="liquid-gradient px-8 py-3 rounded-2xl font-black italic text-sm shadow-xl shadow-brand-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2 shrink-0">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            THÊM TÀI XẾ
        </a>
    </div>

    @if (session('success'))
    <div class="glass-dark border-l-4 border-emerald-500 p-4 rounded-2xl animate-fade-in">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center">
                <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
            </div>
            <p class="text-xs font-bold">{{ session('success') }}}</p>
        </div>
    </div>
    @endif

    <!-- Table Container -->
    <div class="glass-dark rounded-4xl border-none ring-1 ring-white/5 overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-white/20">{{{ __('drivers') }}</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-white/20">{{{ __('contact') }}</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-white/20">Bằng lái</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-white/20">{{{ __('status') }}</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-white/20 text-right">{{{ __('actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.02]">
                    @if ($drivers->count() > 0)
                        @foreach ($drivers as $driver)
                        <tr class="group hover:bg-white/[0.02] transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl overflow-hidden ring-1 ring-white/10 group-hover:ring-brand-accent/30 transition-all">
                                        @if ($driver->image)
                                            <img src="{{ asset($driver->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full liquid-gradient flex items-center justify-center font-black text-xs italic">
                                                {{ substr($driver->name, 0, 1) }}}</div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm">{{ $driver->name }}}</p>
                                        <p class="text-[10px] font-black uppercase text-white/20 tracking-tighter">ID: #{{ $driver->id }}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2 text-xs font-bold">
                                        <i data-lucide="phone" class="w-3 h-3 text-brand-accent"></i>
                                        <span>{{ $driver->phone }}}</span>
                                    </div>
                                    <p class="text-[10px] text-white/30 font-medium">user{{ $driver->id }}@manhhung.vn</p>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="glass px-3 py-1.5 rounded-xl border border-white/5 inline-flex items-center gap-2">
                                    <i data-lucide="id-card" class="w-3.5 h-3.5 text-white/40"></i>
                                    <span class="text-[10px] font-black uppercase tracking-widest">{{ $driver->license_number }}}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                @php
                                    $statusConfig = [
                                        'active' => ['color' => 'emerald-400', 'label' => 'Sẵn sàng'],
                                        'busy' => ['color' => 'brand-accent', 'label' => 'Đang chạy'],
                                        'inactive' => ['color' => 'red-400', 'label' => 'Nghỉ lễ'],
                                    ][$driver->status] ?? ['color' => 'white/20', 'label' => 'K.Xác định'];
                                @endphp
                                <div class="flex items-center gap-2 text-xs font-bold text-{{ $statusConfig['color'] }}">
                                    <div class="w-1.5 h-1.5 rounded-full bg-{{ $statusConfig['color'] }}} shadow-[0_0_8px] shadow-{{ $statusConfig['color'] }}/50"></div>
                                    <span>{{ $statusConfig['label'] }}}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.drivers.show', $driver->id) }}" class="w-9 h-9 glass rounded-xl flex items-center justify-center hover:bg-brand-accent hover:text-brand-dark transition-all">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>
                                    <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="w-9 h-9 glass rounded-xl flex items-center justify-center hover:bg-brand-primary hover:text-white transition-all">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" class="contents" 
                                          onsubmit="return confirm('Xác nhận xoá tài xế?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 glass rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center space-y-4">
                                <div class="w-16 h-16 rounded-full bg-white/5 mx-auto flex items-center justify-center border border-dashed border-white/10 opacity-30">
                                    <i data-lucide="search-x" class="w-8 h-8"></i>
                                </div>
                                <p class="text-sm font-bold text-white/20 uppercase tracking-widest">Không tìm thấy dữ liệu phù hợp</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if($drivers->hasPages())
        <div class="px-8 py-6 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] font-bold text-white/30 uppercase tracking-widest">
                Hiển thị <span class="text-white">{{ $drivers->count() }}}</span> / {{ $drivers->total() }}} tài xế
            </p>
            <div class="admin-pagination">
                {{ $drivers->appends(request()->query())->links() }}}</div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Custom pagination styling if needed
</script>
@endpush
