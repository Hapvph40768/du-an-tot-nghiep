<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Xem danh sách toàn bộ vé (có thể thêm bộ lọc theo chuyến đi ở View)
    public function index(Request $request)
    {
        $tickets = Ticket::with(['booking.user', 'trip.route', 'seat'])
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('admin.tickets.index', compact('tickets'));
    }

    // Xem chi tiết 1 vé
    public function show(Ticket $ticket)
    {
        $ticket->load(['booking.user', 'trip.route', 'seat']);
        return view('admin.tickets.show', compact('ticket'));
    }

    // Soát vé: Cập nhật trạng thái vé
    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,used',
        ]);

        $ticket->update($validated);
        
        return back()->with('success', 'Đã cập nhật trạng thái vé thành công!');
    }
}