<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'message' => 'required|string|max:5000',
            'type'    => 'nullable|in:payment,ticket,complaint',
        ]);

        $userId = Auth::check() ? Auth::id() : null;

        $ticket = SupportTicket::create([
            'user_id' => $userId,
            'type'    => $request->input('type', 'ticket'),
            'description' => $request->message,
            'status'  => 'open',
        ]);

        SupportMessage::create([
            'support_ticket_id' => $ticket->id,
            'sender_id'         => $userId,
            'message'           => "Họ tên: {$request->name}\nSĐT: {$request->phone}\n\n" . $request->message,
        ]);


        return redirect()
            ->to(url()->previous() . '#contact')
            ->with('success', 'Yêu cầu hỗ trợ của bạn đã được gửi thành công! Chúng tôi sẽ phản hồi sớm nhất có thể.');
    }
}
