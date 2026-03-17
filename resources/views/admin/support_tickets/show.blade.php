@extends('layout.admin.AdminLayout')

@section('content-main')
<div class="container-fluid py-4">
    <a href="{{ route('admin.support_tickets.index') }}" class="btn btn-link text-decoration-none mb-3 p-0">
        <i class='bx bx-arrow-back'></i> Quay lại danh sách
    </a>

    <div class="row">
        {{-- Thông tin khách hàng & Booking --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">Thông tin yêu cầu</div>
                <div class="card-body">
                    {{-- Sửa thành $supportTicket --}}
                    <p><strong>Khách hàng:</strong> {{ $supportTicket->user->name ?? 'Không có thông tin' }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $supportTicket->user->phone ?? 'Không có thông tin' }}</p>
                    <p><strong>Vấn đề:</strong> {{ $supportTicket->description }}</p>
                    <hr>
                    @if($supportTicket->booking)
                        <p class="text-primary fw-bold">Thông tin vé xe:</p>
                        <p>Mã đặt vé: #{{ $supportTicket->booking->id }}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Khung Chat --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between">
                    <span class="fw-bold text-primary">Lịch sử trò chuyện</span>
                    <form action="{{ route('admin.support_tickets.close', $supportTicket->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button class="btn btn-sm btn-outline-secondary">Đóng Ticket</button>
                    </form>
                </div>
                <div class="card-body bg-light" style="height: 400px; overflow-y: auto;" id="admin-chat-box">
                    @foreach($supportTicket->messages as $msg)
                        <div class="d-flex mb-3 {{ $msg->sender_type == 'admin' ? 'justify-content-end' : 'justify-content-start' }}">
                            <div class="p-3 rounded-4 shadow-sm {{ $msg->sender_type == 'admin' ? 'bg-primary text-white' : 'bg-white' }}" style="max-width: 75%;">
                                <div class="small fw-bold mb-1">{{ $msg->sender_type == 'admin' ? 'Bạn' : $supportTicket->user->name }}</div>
                                <div>{{ $msg->message }}</div>
                                <div class="text-end" style="font-size: 10px; opacity: 0.7;">{{ $msg->created_at->format('H:i') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer bg-white border-top-0">
                    <form action="{{ route('admin.support_tickets.reply', $supportTicket->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input name="message" type="text" class="form-control border-0 bg-light" placeholder="Nhập phản hồi cho khách hàng..." required>
                            <button class="btn btn-primary px-4">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection