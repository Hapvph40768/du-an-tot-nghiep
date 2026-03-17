<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportMessageController extends Controller
{
    /**
     * Admin gửi tin nhắn phản hồi trong một Ticket
     */
    public function store(Request $request, SupportTicket $supportTicket)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // 1. Lưu tin nhắn vào bảng support_messages
        SupportMessage::create([
            'support_ticket_id' => $supportTicket->id,
            'sender_id' => Auth::id(),
            'sender_type' => 'admin', // Định danh người gửi là admin
            'message' => $request->message,
        ]);

        // 2. Cập nhật trạng thái Ticket sang 'processing' (đang xử lý)
        // và gán admin hiện tại vào ticket nếu chưa có ai nhận
        $supportTicket->update([
            'status' => 'processing',
            'assigned_admin_id' => $supportTicket->assigned_admin_id ?? Auth::id()
        ]);

        return back()->with('success', 'Đã gửi phản hồi thành công.');
    }

    /**
     * Thu hồi/Xóa tin nhắn (nếu Admin nhắn nhầm)
     */
    public function destroy(SupportMessage $supportMessage)
    {
        // Chỉ cho phép admin xóa tin nhắn của chính mình
        if ($supportMessage->sender_id !== Auth::id()) {
            return back()->with('error', 'Bạn không có quyền xóa tin nhắn này.');
        }

        $supportMessage->delete();
        return back()->with('success', 'Đã thu hồi tin nhắn.');
    }
}