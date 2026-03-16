<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    // ... (Các hàm index, create, store, show giữ nguyên như cũ)

    /**
     * Khách hàng gửi thêm tin nhắn vào Ticket hiện có
     */
    public function sendMessage(Request $request, SupportTicket $supportTicket)
    {
        // Kiểm tra bảo mật: Đảm bảo khách hàng chỉ có thể nhắn tin vào ticket của chính họ
        if ($supportTicket->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền gửi tin nhắn vào yêu cầu này.');
        }

        // Nếu ticket đã đóng thì không cho nhắn nữa
        if ($supportTicket->status === 'closed') {
            return back()->with('error', 'Yêu cầu hỗ trợ này đã được đóng. Vui lòng tạo yêu cầu mới nếu cần.');
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        // 1. Lưu tin nhắn
        SupportMessage::create([
            'support_ticket_id' => $supportTicket->id,
            'sender_id' => Auth::id(),
            'sender_type' => 'user', // Định danh là khách hàng gửi
            'message' => $request->message,
        ]);

        // 2. Chuyển trạng thái ticket về 'open' nếu Admin đã trả lời xong 
        // để Admin thấy có tin nhắn mới cần xử lý (status processing -> open)
        if ($supportTicket->status === 'processing') {
            $supportTicket->update(['status' => 'open']);
        }

        return back()->with('success', 'Đã gửi phản hồi.');
    }
}