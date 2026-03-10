<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{

    // admin/staff xem tất cả ticket
    public function index()
    {
        $tickets = SupportTicket::with('user')->latest()->get();

        return view('admin.support.index', compact('tickets'));
    }

    // mở chat
    public function show($id)
    {
        $ticket = SupportTicket::with('messages.sender','user')->findOrFail($id);

        return view('admin.support.chat', compact('ticket'));
    }

    // trả lời
    public function reply(Request $request, $ticketId)
    {
        SupportMessage::create([
            'support_ticket_id' => $ticketId,
            'sender_id' => Auth::id(),
            'message' => $request->message
        ]);

        return back();
    }

}