<?php

namespace App\Http\Controllers\Admin;

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

        return view('admin.support.index', compact('tickets'));
    }

    public function show($id)
    {
        $supportTicket = SupportTicket::with(['user', 'messages.sender'])->findOrFail($id);
        return view('admin.support.chat', compact('supportTicket'));
    }

    public function reply(Request $request, $id)
    {
        $supportTicket = SupportTicket::findOrFail($id);

        $request->validate([
            'message' => 'required|string|min:2|max:5000',
        ]);

        $message = $supportTicket->messages()->create([
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);

        $message->load('sender');

        return response()->json([
            'name' => $message->sender->name,
            'message' => $message->message,
            'sender_id' => $message->sender_id
        ]);
    }
    public function updateStatus(Request $request, $id)
    {
        $supportTicket = SupportTicket::findOrFail($id);
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
