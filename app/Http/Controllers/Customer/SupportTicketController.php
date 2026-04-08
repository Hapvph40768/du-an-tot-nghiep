<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::where('user_id', Auth::id())->latest()->get();
        return view('customer.support.index', compact('tickets'));
    }

    public function create()
    {
        // Lấy danh sách vé đã đặt của khách để họ chọn nhanh trong dropdown
        $bookings = \App\Models\Booking::where('user_id', Auth::id())
            ->with('trip.route')
            ->latest()
            ->get();


            
        $tickets = SupportTicket::where('user_id', Auth::id())
            ->latest()
            ->get(); // 👈 THÊM DÒNG NÀY

        return view('customer.support.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:payment,ticket,complaint',
            'description' => 'required|string',
            'booking_id' => 'nullable|exists:bookings,id'
        ]);

        SupportTicket::create([
            'user_id' => Auth::id(),
            'booking_id' => $request->booking_id,
            'type' => $request->type,
            'description' => $request->description,
            'status' => 'open',
        ]);

        return redirect()->route('customer.support.index')->with('success', 'Đã gửi yêu cầu hỗ trợ thành công. Chúng tôi sẽ phản hồi sớm nhất.');
    }

    public function show(SupportTicket $supportTicket)
    {
        if ($supportTicket->user_id !== Auth::id()) {
            abort(403);
        }

        $supportTicket->load('messages.sender');
        return view('customer.support.show', compact('supportTicket'));
    }
}
