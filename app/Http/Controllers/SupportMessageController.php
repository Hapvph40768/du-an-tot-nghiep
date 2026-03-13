<?php

namespace App\Http\Controllers;

use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportMessageController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $support_ticket = SupportTicket::findOrFail($id);
        $user = Auth::user();

        // Kiểm tra quyền truy cập ticket
        if ($user->role !== 'admin' && $support_ticket->user_id !== $user->id) {
            abort(403);
        }

        // Không cho gửi nếu ticket đã đóng
        if ($support_ticket->status === 'closed') {
            return back()->with('error', 'Ticket đã đóng');
        }

        // Lưu tin nhắn
        SupportMessage::create([
            'support_ticket_id' => $support_ticket->id,
            'sender_id' => $user->id,
            'message' => $request->message
        ]);

        // Nếu người gửI là khách hàng, gửi tin nhắn tự động
        if ($user->role === 'customer') {
             $adminId = User::where('role', 'admin')->first()->id ?? null;
             
             $aiService = new \App\Services\AiSupportService();
             $replyMsg = $aiService->generateReply($support_ticket, $request->message);

             SupportMessage::create([
                 'support_ticket_id' => $support_ticket->id,
                 'sender_id' => $adminId,
                 'message' => $replyMsg
             ]);
             
             // Cập nhật trạng thái quay lại xử lý nếu lỡ đóng rồi
             if ($support_ticket->status !== 'processing') {
                  $support_ticket->update(['status' => 'processing']);
             }
        }

        return back()->with('success', 'Gửi tin nhắn thành công');
    }
}