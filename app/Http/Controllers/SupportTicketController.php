<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::with(['user', 'messages.sender'])
            ->latest()
            ->paginate(15);

        return view('admin.support-tickets.index', compact('tickets'));
    }

    public function show(SupportTicket $supportTicket)
    {
        $supportTicket->load(['user', 'messages.sender']);

        return view('admin.support-tickets.show', compact('supportTicket'));
    }

    public function reply(Request $request, SupportTicket $supportTicket)
    {
        $request->validate([
            'message' => 'required|string|min:2|max:5000',
        ]);

        $supportTicket->messages()->create([
            'sender_id' => Auth::id(),
            'message'   => $request->message,
        ]);

        return redirect()
            ->route('support-tickets.show', $supportTicket)
            ->with('success', 'Đã gửi phản hồi thành công.');
    }

    public function updateStatus(Request $request, SupportTicket $supportTicket)
    {
        $request->validate([
            'status' => 'required|in:open,processing,closed',
        ]);

        $supportTicket->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Cập nhật trạng thái ticket thành công.');
    }
}