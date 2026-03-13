<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::where('user_id', Auth::id())
            ->with(['messages.sender'])
            ->latest()
            ->paginate(15);

        return view('customer.support.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:payment,ticket,complaint',
            'description' => 'required|string|min:10|max:5000',
        ]);

        $ticket = SupportTicket::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'description' => $request->description,
            'status' => 'open'
        ]);

        // Tin nhắn đầu tiên
        $ticket->messages()->create([
            'sender_id' => Auth::id(),
            'message' => $request->description,
        ]);

        // Auto reply
        $this->autoReply($ticket);

        return redirect()
            ->route('customer.support.show', $ticket->id)
            ->with('success','Đã tạo yêu cầu hỗ trợ thành công.');
    }

    public function show($id)
    {
        $ticket = SupportTicket::where('id',$id)
            ->where('user_id',Auth::id())
            ->with(['messages.sender'])
            ->firstOrFail();

        return view('customer.support.chat', compact('ticket'));
    }

    private function autoReply(SupportTicket $ticket)
    {
        $admin = User::where('role','admin')->first();

        $adminId = $admin ? $admin->id : null;

        $aiService = new \App\Services\AiSupportService();

        $reply = $aiService->generateReply($ticket,'');

        $ticket->messages()->create([
            'sender_id' => $adminId,
            'message' => $reply,
        ]);
    }
}