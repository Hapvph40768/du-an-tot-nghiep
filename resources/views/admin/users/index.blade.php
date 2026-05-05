@extends('layout.admin')

@section('header-title', 'Quản lý Tài khoản')
@section('header-subtitle', 'Phân quyền và quản lý người dùng hệ thống')

@section('content-main')
<div class="space-y-8">
    <!-- Header Summary -->
    <div class="glass-dark p-8 rounded-4xl border-none ring-1 ring-white/5 flex flex-wrap items-center justify-between gap-8">
        <div class="flex items-center gap-6">
            <div class="w-14 h-14 rounded-2xl liquid-gradient flex items-center justify-center shadow-lg shadow-brand-primary/20">
                <i data-lucide="users" class="w-8 h-8"></i>
            </div>
            <div>
                <h2 class="text-3xl font-black italic tracking-tighter">NGƯỜI DÙNG</h2>
                <p class="text-xs text-white/30 font-bold uppercase tracking-widest">Hệ thống có {{ $users->total() }} thành viên</p>
            </div>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="bg-white/5 px-6 py-3 rounded-2xl border border-white/5 space-y-1">
                <p class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest leading-none">{{ __('active') }}</p>
                <p class="text-sm font-bold">{{ $users->where('status', 'active')->count() }} Active</p>
            </div>
        </div>
    </div>

    {{ -- Thông báo -- }} @if (session('success'))
        <div class="glass-dark border-l-4 border-emerald-500 p-6 rounded-3xl animate-fade-in flex items-center gap-4">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500"></i>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Table Container -->
    <div class="glass-dark rounded-4xl border-none ring-1 ring-white/5 overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-white/20">Họ tên / Email</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-white/20">{{ __('role') }}</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-white/20">{{ __('contact') }}</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-white/20">{{ __('status') }}</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-white/20 text-right">{{ __('actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.02]">
                    @foreach ($users as $user)
                    <tr class="group hover:bg-white/[0.02] transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex flex-col">
                                <span class="font-bold text-sm">{{ $user->name }}</span>
                                <span class="text-[10px] font-medium text-white/30">{{ $user->email }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            @php
                                $roleConfig = [
                                    'admin' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-500', 'label' => 'Quản trị'],
                                    'staff' => ['bg' => 'bg-brand-accent/10', 'text' => 'text-brand-accent', 'label' => 'Nhân viên'],
                                    'customer' => ['bg' => 'bg-white/5', 'text' => 'text-white/40', 'label' => 'Khách hàng'],
                                ][$user->role] ?? ['bg' => 'bg-white/5', 'text' => 'text-white/20', 'label' => $user->role];
                            @endphp
                            <span class="px-3 py-1 rounded-full {{ $roleConfig['bg'] }} {{ $roleConfig['text'] }} text-[10px] font-black uppercase tracking-widest border border-white/5">
                                {{ $roleConfig['label'] }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-xs font-bold text-white/60 italic tracking-tighter">{{ $user->phone ?? '—' }}</span>
                        </td>
                        <td class="px-8 py-6">
                            @if($user->status == 'active')
                                <div class="flex items-center gap-2 text-xs font-bold text-emerald-400">
                                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.5)]"></div>
                                    <span>Đang chạy</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-xs font-bold text-red-400">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-400"></div>
                                    <span>Đã khóa</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-2 opacity-40 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="w-9 h-9 glass rounded-xl flex items-center justify-center hover:bg-white/10 transition-all">
                                    <i data-lucide="settings-2" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="contents">
                                    @csrf
                                    <button type="submit" class="w-9 h-9 glass rounded-xl flex items-center justify-center hover:bg-white/10 transition-all {{ $user->status === 'active' ? 'text-red-400' : 'text-emerald-400' }}">
                                        <i data-lucide="{{ $user->status === 'active' ? 'lock' : 'unlock' }}" class="w-4 h-4"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Xác nhận xóa tài khoản?')">
                                    @csrf @method('DELETE')
                                    <button class="w-9 h-9 glass rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-8 py-6 border-t border-white/5">
            {{ $users->links() }}</div>
    </div>
</div>
@endsection
