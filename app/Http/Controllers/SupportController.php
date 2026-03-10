<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{

    // CUSTOMER: danh sách ticket
    public function index()
    {
        $tickets = SupportTicket::where('user_id', Auth::id())->get();

        return view('customer.support.index', compact('tickets'));
    }

    // tạo ticket
    public function store(Request $request)
    {
        $ticket = SupportTicket::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'description' => $request->description
        ]);

        return redirect()->route('customer.support.show', $ticket->id);
    }

    // mở chatbox
    public function show($id)
    {
        $ticket = SupportTicket::with('messages.sender')->findOrFail($id);

        return view('customer.support.chat', compact('ticket'));
    }

    // gửi tin nhắn
    public function sendMessage(Request $request, $ticketId)
    {
        SupportMessage::create([
            'support_ticket_id' => $ticketId,
            'sender_id' => Auth::id(),
            'message' => $request->message
        ]);

        return back();
    }
}