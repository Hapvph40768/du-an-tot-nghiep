<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Ticket;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssistantTripController extends Controller
{
    public function index()
    {
        $trips = Trip::with([
            'route.departureLocation',
            'route.destinationLocation',
            'vehicle',
            'pickupPoints'
        ])
            ->whereIn('status', ['active', 'running'])
            ->orderBy('trip_date', 'desc')
            ->orderBy('departure_time')
            ->paginate(12);

        return view('assistant.trips.index', compact('trips'));
    }

    public function history(Request $request)
    {
        $trips = Trip::with(['route.departureLocation', 'route.destinationLocation', 'vehicle', 'pickupPoints'])
            ->whereIn('status', ['completed', 'canceled'])
            ->orderBy('trip_date', 'desc')
            ->orderBy('departure_time', 'desc')
            ->paginate(12);

        return view('assistant.trips.history', compact('trips'));
    }

    public function revenue(Request $request)
    {
        $query = Trip::with([
            'route.departureLocation', 
            'route.destinationLocation', 
            'vehicle',
            'tickets.booking.payment'
        ])->where('status', 'completed');

        $trips = $query->orderBy('trip_date', 'desc')->paginate(12);
        
        $statsQuery = Trip::where('status', 'completed');
        $allTripIds = $statsQuery->pluck('id');
        $totalRevenue = Payment::where('status', 'success')
            ->whereHas('booking', function($query) use ($allTripIds) {
                $query->whereIn('trip_id', $allTripIds);
            })->sum('amount');
            
        return view('assistant.trips.revenue', compact('trips', 'totalRevenue'));
    }

    public function show(Trip $trip)
    {
        $trip->load([
            'route.departureLocation',
            'route.destinationLocation',
            'vehicle.seats',
            'pickupPoints',
            'tickets' => function ($query) {
                $query->where('status', '!=', 'cancelled')
                    ->with(['seat', 'booking.user', 'booking.pickupPoint']);  
            },
            'bookings.user'   
        ]);

        return view('assistant.trips.show', compact('trip'));
    }

    public function start(Trip $trip, Request $request)
    {
        if ($trip->status !== 'active') {
            return back()->with('error', 'Chuyến này không thể bắt đầu.');
        }

        $trip->update(['status' => 'running']);

        return redirect()->route('assistant.trips.show', $trip)
            ->with('success', 'Chuyến xe đã khởi hành!');
    }

    public function checkinTicket(Request $request, Trip $trip)
    {
        $request->validate([
            'ticket_code' => 'required|string',
        ]);

        $ticket = Ticket::where('ticket_code', $request->ticket_code)->where('trip_id', $trip->id)->first();

        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'Mã vé không hợp lệ hoặc không thuộc chuyến xe này.']);
        }

        if ($ticket->status === 'used') {
            return response()->json(['success' => false, 'message' => 'Vé này đã được check-in / sử dụng rồi.']);
        }

        if ($ticket->status === 'cancelled') {
            return response()->json(['success' => false, 'message' => 'Vé này đã bị hủy.']);
        }

        $ticket->update(['status' => 'used']);

        return response()->json([
            'success' => true, 
            'message' => 'Check-in thành công cho vé: ' . $ticket->ticket_code,
            'ticket_id' => $ticket->id,
            'seat_number' => $ticket->seat->seat_number ?? $ticket->seat_number
        ]);
    }

    public function collectCash(Ticket $ticket)
    {
        $booking = $ticket->booking;
        if (!$booking) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy thông tin đặt vé.']);
        }

        if ($booking->status === 'paid') {
            return response()->json(['success' => false, 'message' => 'Đơn đặt vé này đã được thanh toán.']);
        }
        
        $booking->update(['status' => 'paid']);
        
        $payment = $booking->payment;
        if ($payment) {
            $payment->update([
                'payment_method' => 'cash',
                'status' => 'success',
            ]);
        } else {
            Payment::create([
                'booking_id' => $booking->id,
                'payment_method' => 'cash',
                'amount' => $booking->total_amount,
                'status' => 'success',
                'transaction_code' => 'CASH-' . time() . '-' . rand(100, 999)
            ]);
        }

        if ($ticket->status === 'pending') {
            $ticket->update(['status' => 'confirmed']);
        }

        return response()->json([
            'success' => true, 
            'message' => 'Thu tiền mặt thành công!',
            'ticket_status' => $ticket->status,
            'ticket_id' => $ticket->id
        ]);
    }

    public function storeWalkIn(Request $request, Trip $trip)
    {
        try {
            $request->validate([
            'seat_id' => 'required',
            'passenger_name' => 'required|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        $existingTicket = Ticket::where('trip_id', $trip->id)->where('seat_id', $request->seat_id)->first();
        if ($existingTicket) {
            if ($existingTicket->status !== 'cancelled') {
                return response()->json(['success' => false, 'message' => 'Ghế này đã có người đặt.']);
            }
            $existingTicket->delete();
        }

        $pickupPointId = $trip->pickupPoints->first()->id ?? null;
        if(!$pickupPointId) {
            $pickup = \App\Models\PickupPoint::first();
            if($pickup) $pickupPointId = $pickup->id;
        }

        $booking = Booking::create([
            'user_id' => Auth::id() ?? 1,
            'trip_id' => $trip->id,
            'pickup_point_id' => $pickupPointId,
            'contact_name' => $request->passenger_name,
            'contact_phone' => $request->contact_phone ?? '0000000000',
            'total_amount' => $trip->price ?? 0,
            'status' => 'paid'
        ]);

        Payment::create([
            'booking_id' => $booking->id,
            'payment_method' => 'cash',
            'amount' => $trip->price ?? 0,
            'status' => 'success',
            'transaction_code' => 'WALK-' . strtoupper(\Illuminate\Support\Str::random(5))
        ]);

        $ticket = Ticket::create([
            'booking_id' => $booking->id,
            'trip_id' => $trip->id,
            'seat_id' => $request->seat_id,
            'status' => 'used', 
        ]);

        $ticket->load('seat');

        return response()->json([
            'success' => true, 
            'message' => 'Bán vé dọc đường thành công!',
            'ticket' => [
                'id' => $ticket->id,
                'code' => $ticket->ticket_code,
                'seat_number' => $ticket->seat->seat_number,
                'name' => $request->passenger_name,
                'phone' => $request->contact_phone ?? '--',
                'status' => 'used',
                'pickup' => 'Bắt dọc đường'
            ]
        ]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage() . ' tại ' . basename($e->getFile()) . ':' . $e->getLine()]);
        }
    }
}
