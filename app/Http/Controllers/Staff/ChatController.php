<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatSession;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $sessions = ChatSession::with('user')
            ->orderByRaw("CASE 
                WHEN status = 'waiting_staff' THEN 1 
                WHEN status = 'staff_replying' THEN 2 
                ELSE 3 END")
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('staff.chat.index', compact('sessions'));
    }

    public function show($id)
    {
        $session = ChatSession::findOrFail($id);
        $history = DB::table('chat_histories')
            ->where('session_id', $session->session_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('staff.chat.show', compact('session', 'history'));
    }

    public function reply(Request $request, $id)
    {
        $session = ChatSession::findOrFail($id);
        $message = $request->input('message');

        DB::table('chat_histories')->insert([
            'user_id' => auth()->id(),
            'session_id' => $session->session_id,
            'role' => 'staff',
            'message' => $message,
            'created_at' => now(),
        ]);

        $session->update(['status' => 'staff_replying']);

        return back()->with('success', 'Đã gửi phản hồi.');
    }

    public function close($id)
    {
        $session = ChatSession::findOrFail($id);
        $session->update(['status' => 'bot']);
        
        return redirect()->route('staff.chat.index')->with('success', 'Đã đóng hỗ trợ, chuyển lại cho AI.');
    }
}
