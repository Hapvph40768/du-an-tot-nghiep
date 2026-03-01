@extends('layout.admin.AdminLayout')

@section('content-main')
    <div class="container-fluid py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold text-dark mb-1">
                    <i class="bx bx-support me-2 text-primary"></i>
                    Ticket #{{ $supportTicket->id }}
                </h4>
                <div class="text-muted small">
                    <span class="me-2">Từ: <strong>{{ $supportTicket->user?->name ?? 'Khách' }}</strong></span>
                    <span class="me-2">• {{ $supportTicket->user?->email ?? 'N/A' }}</span>
                    <span>• {{ \Carbon\Carbon::parse($supportTicket->created_at)->diffForHumans() }}</span>
                </div>
            </div>

            <form action="{{ route('support-tickets.update-status', $supportTicket) }}" method="POST" class="d-flex align-items-center gap-3">
                @csrf @method('PATCH')
                <label class="form-label fw-medium mb-0 text-nowrap">Trạng thái:</label>
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="open"     {{ $supportTicket->status === 'open'     ? 'selected' : '' }}>Mở</option>
                    <option value="processing" {{ $supportTicket->status === 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                    <option value="closed"   {{ $supportTicket->status === 'closed'   ? 'selected' : '' }}>Đóng</option>
                </select>
            </form>
        </div>

        <div class="card shadow border-0 rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="chat-container p-4" style="max-height: 65vh; overflow-y: auto; background: #f9fafb;">
                    @forelse ($supportTicket->messages as $msg)
                        @php
                            $isAdmin = $msg->sender_id === auth()->id();
                            $senderName = $msg->sender?->name ?? ($isAdmin ? 'Bạn' : 'Khách');
                            $avatarBg = $isAdmin ? 'bg-primary-subtle text-primary' : 'bg-secondary-subtle text-secondary';
                            $bubbleBg = $isAdmin ? 'bg-primary text-white' : 'bg-white border shadow-sm';
                            $align = $isAdmin ? 'justify-content-end' : 'justify-content-start';
                        @endphp

                        <div class="d-flex {{ $align }} mb-4">
                            @if (!$isAdmin)
                                <div class="avatar avatar-sm rounded-circle me-3 d-flex align-items-center justify-content-center fw-bold {{ $avatarBg }}">
                                    {{ strtoupper(substr($senderName, 0, 1)) }}
                                </div>
                            @endif

                            <div class="message-bubble {{ $bubbleBg }} p-3 rounded-3" style="max-width: 75%;">
                                <div class="small opacity-75 mb-1">
                                    {{ $senderName }} • {{ \Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                                </div>
                                <div class="message-content">
                                    {!! nl2br(e($msg->message)) !!}
                                </div>
                            </div>

                            @if ($isAdmin)
                                <div class="avatar avatar-sm rounded-circle ms-3 d-flex align-items-center justify-content-center fw-bold {{ $avatarBg }}">
                                    {{ strtoupper(substr($senderName, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bx bx-message-dots fs-2 mb-3 d-block"></i>
                            Chưa có tin nhắn nào
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="card-footer bg-white border-0 p-4">
                <form action="{{ route('support-tickets.reply', $supportTicket) }}" method="POST">
                    @csrf
                    <div class="input-group input-group-lg">
                        <textarea name="message" class="form-control rounded-pill rounded-end-0 border-end-0 py-3" rows="1"
                                  placeholder="Nhập phản hồi..." required style="resize: none;"></textarea>
                        <button type="submit" class="btn btn-primary rounded-pill rounded-start-0 px-4">
                            <i class="bx bx-send"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chat = document.querySelector('.chat-container');
            if (chat) chat.scrollTop = chat.scrollHeight;
        });
    </script>
@endsection