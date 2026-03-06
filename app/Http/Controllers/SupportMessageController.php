<?php

namespace App\Http\Controllers;

use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportMessageController extends Controller
{
    public function store(Request $request, SupportTicket $support_ticket)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

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

        return back()->with('success', 'Gửi tin nhắn thành công');
    }
}