<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    // Xem danh sách các yêu cầu hỗ trợ
    public function index()
    {
        $tickets = SupportTicket::with(['user', 'booking'])->latest()->paginate(20);
        return view('admin.support_tickets.index', compact('tickets'));
    }

    // Xem chi tiết yêu cầu và lịch sử tin nhắn
    public function show(SupportTicket $supportTicket)
    {
        $supportTicket->load(['user', 'booking', 'messages.sender', 'assignedAdmin']);
        return view('admin.support_tickets.show', compact('supportTicket'));
    }

    // Admin trả lời tin nhắn của khách hàng
    public function reply(Request $request, SupportTicket $supportTicket)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // Tạo tin nhắn mới
        SupportMessage::create([
            'support_ticket_id' => $supportTicket->id,
            'sender_id' => Auth::id(), // ID của admin đang trả lời
            'sender_type' => 'admin',
            'message' => $request->message,
        ]);

        // Cập nhật trạng thái ticket và gán cho admin hiện tại nếu chưa có ai nhận
        $supportTicket->update([
            'status' => 'processing',
            'assigned_admin_id' => $supportTicket->assigned_admin_id ?? Auth::id(),
        ]);

        return back()->with('success', 'Đã gửi phản hồi.');
    }

    // Đóng ticket khi đã xử lý xong
    public function close(SupportTicket $supportTicket)
    {
        $supportTicket->update(['status' => 'closed']);
        return back()->with('success', 'Đã đóng yêu cầu hỗ trợ.');
    }
}