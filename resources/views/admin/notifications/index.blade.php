@extends('layout.admin')

@section('title', 'Thông báo hệ thống')
@section('header-title', 'Thông báo')
@section('header-subtitle', 'Tất cả thông báo từ khách hàng và hệ thống')

@section('content-main')
<div class="container-fluid py-4 px-3 px-md-4">

    {{-- Summary Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
                <div style="width:46px;height:46px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class='bx bx-bell text-white fs-5'></i>
                </div>
                <div>
                    <div class="fw-bold fs-5">{{ $notifications->total() }}</div>
                    <div class="text-muted" style="font-size:12px;">Tổng thông báo</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
                <div style="width:46px;height:46px;background:linear-gradient(135deg,#f59e0b,#ef4444);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class='bx bx-bell-ring text-white fs-5'></i>
                </div>
                <div>
                    <div class="fw-bold fs-5">{{ auth()->user()->unreadNotifications->count() }}</div>
                    <div class="text-muted" style="font-size:12px;">Chưa đọc</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
                <div style="width:46px;height:46px;background:linear-gradient(135deg,#10b981,#059669);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class='bx bx-support text-white fs-5'></i>
                </div>
                <div>
                    <div class="fw-bold fs-5">
                        {{ auth()->user()->notifications->filter(fn($n) => str_contains($n->type, 'SupportTicket'))->count() }}
                    </div>
                    <div class="text-muted" style="font-size:12px;">Hỗ trợ mới</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
                <div style="width:46px;height:46px;background:linear-gradient(135deg,#3b82f6,#06b6d4);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class='bx bx-package text-white fs-5'></i>
                </div>
                <div>
                    <div class="fw-bold fs-5">
                        {{ auth()->user()->notifications->filter(fn($n) => str_contains($n->type, 'Parcel'))->count() }}
                    </div>
                    <div class="text-muted" style="font-size:12px;">Ký gửi mới</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 d-flex align-items-center gap-2">
                <i class='bx bx-bell' style="color:#6366f1;"></i>
                Danh sách thông báo
            </h5>
            @if(auth()->user()->unreadNotifications->count() > 0)
            <form method="POST" action="{{ route('admin.notifications.readAll') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                    <i class='bx bx-check-double me-1'></i> Đánh dấu tất cả đã đọc
                </button>
            </form>
            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success mx-4 mb-0 rounded-3">{{ session('success') }}</div>
        @endif

        <div class="card-body p-0">
            @forelse($notifications as $notif)
                @php
                    $data = $notif->data;
                    $isUnread = is_null($notif->read_at);
                    $icon = $data['icon'] ?? 'bx bx-bell';
                    $title = $data['title'] ?? 'Thông báo';
                    $message = $data['message'] ?? '';
                    $url = $data['url'] ?? '#';

                    // Icon color by type
                    if (str_contains($notif->type, 'SupportTicket')) {
                        $iconBg = 'linear-gradient(135deg,#10b981,#059669)';
                    } elseif (str_contains($notif->type, 'Parcel')) {
                        $iconBg = 'linear-gradient(135deg,#3b82f6,#06b6d4)';
                    } else {
                        $iconBg = 'linear-gradient(135deg,#6366f1,#8b5cf6)';
                    }
                @endphp
                <div class="notif-item d-flex align-items-start gap-3 px-4 py-3 {{ $isUnread ? 'notif-unread' : '' }}"
                     data-id="{{ $notif->id }}" id="notif-{{ $notif->id }}">

                    {{-- Icon --}}
                    <div class="notif-icon flex-shrink-0" style="width:42px;height:42px;background:{{ $iconBg }};border-radius:12px;display:flex;align-items:center;justify-content:center;margin-top:2px;">
                        <i class="{{ $icon }} text-white" style="font-size:18px;"></i>
                    </div>

                    {{-- Content --}}
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-1">
                            <div>
                                <span class="fw-semibold" style="font-size:14px;">{{ $title }}</span>
                                @if($isUnread)
                                    <span class="badge bg-danger ms-1 rounded-pill" style="font-size:9px; vertical-align:middle;">Mới</span>
                                @endif
                                <div class="text-muted mt-1" style="font-size:13px;">{{ $message }}</div>
                            </div>
                            <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                                @if($isUnread)
                                <button class="btn btn-xs btn-outline-secondary rounded-pill px-2 py-0 mark-read-btn"
                                        style="font-size:11px;" data-id="{{ $notif->id }}">
                                    <i class='bx bx-check'></i>
                                </button>
                                @endif
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="{{ $url }}" class="btn btn-sm rounded-pill px-3 {{ $isUnread ? 'btn-primary' : 'btn-outline-secondary' }}"
                               style="font-size:12px;" onclick="markRead('{{ $notif->id }}')">
                                <i class='bx bx-link-external me-1'></i>Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
                <hr class="my-0 mx-4" style="opacity:0.06;">
            @empty
                <div class="text-center py-5">
                    <div style="width:80px;height:80px;background:#f1f5f9;border-radius:50%;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;">
                        <i class='bx bx-bell-off' style="font-size:36px;color:#94a3b8;"></i>
                    </div>
                    <p class="text-muted">Không có thông báo nào.</p>
                </div>
            @endforelse
        </div>

        @if($notifications->hasPages())
        <div class="card-footer bg-transparent border-0 px-4 pb-4">
            {{ $notifications->links() }}
        </div>
        @endif
    </div>
</div>

<style>
.notif-item {
    transition: background .15s;
}
.notif-item:hover {
    background: rgba(99,102,241,.04);
}
.notif-unread {
    background: rgba(99,102,241,.05);
    border-left: 3px solid #6366f1;
}
.notif-unread:hover {
    background: rgba(99,102,241,.09);
}
.btn-xs {
    padding: 1px 6px;
    font-size: 11px;
}
</style>

@push('scripts')
<script>
function markRead(id) {
    fetch(`/admin/notifications/${id}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    }).then(() => {
        const el = document.getElementById('notif-' + id);
        if (el) {
            el.classList.remove('notif-unread');
            el.querySelectorAll('.badge.bg-danger').forEach(b => b.remove());
            el.querySelectorAll('.mark-read-btn').forEach(b => b.remove());
            // Update bell count
            updateBellCount();
        }
    });
}

document.querySelectorAll('.mark-read-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        markRead(this.dataset.id);
    });
});

function updateBellCount() {
    const badge = document.querySelector('.notif-btn .badge');
    if (badge) {
        let count = parseInt(badge.textContent.trim()) - 1;
        if (count <= 0) badge.remove();
        else badge.textContent = count;
    }
}
</script>
@endpush
@endsection
