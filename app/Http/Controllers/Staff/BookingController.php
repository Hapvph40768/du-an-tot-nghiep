<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\StaffLog;
use App\Models\Trip;
use App\Models\User;
use App\Models\Ticket;
use App\Models\SeatLock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'trip.route', 'pickupPoint', 'tickets.seat']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%$search%")->orWhere('phone', 'like', "%$search%");
            });
        }

        $bookings = $query->latest()->paginate(15);
        return view('staff.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'trip.route', 'trip.vehicle', 'pickupPoint', 'tickets.seat']);
        return view('staff.bookings.show', compact('booking'));
    }

    public function confirm($id)
    {
        return DB::transaction(function () use ($id) {
            $booking = Booking::lockForUpdate()->find($id);
            if (!$booking || $booking->status !== 'pending') {
                return back()->with('error', 'Không tìm thấy hoặc trạng thái không hợp lệ.');
            }

            $booking->update(['status' => 'paid']);

            StaffLog::create([
                'user_id' => Auth::id(),
                'action' => 'confirm_booking',
                'model_type' => Booking::class,
                'model_id' => $booking->id,
                'description' => "Xác nhận thanh toán cho đơn hàng #{$booking->id}",
                'ip_address' => request()->ip(),
            ]);

            return back()->with('success', 'Đã xác nhận thanh toán thành công.');
        });
    }

    public function cancel($id, Request $request)
    {
        return DB::transaction(function () use ($id, $request) {
            $booking = Booking::lockForUpdate()->find($id);
            if (!$booking || $booking->status === 'cancelled') {
                return back()->with('error', 'Đơn hàng không tồn tại hoặc đã bị hủy.');
            }
            
            $reason = $request->cancellation_reason ?? 'Không rõ lý do';
            
            $booking->update([
                'status' => 'cancelled',
                'cancellation_reason' => $reason
            ]);

            StaffLog::create([
                'user_id' => Auth::id(),
                'action' => 'cancel_booking',
                'model_type' => Booking::class,
                'model_id' => $booking->id,
                'description' => "Hủy đơn hàng #{$booking->id}. Lý do: " . $reason,
                'ip_address' => request()->ip(),
            ]);

            return back()->with('success', 'Đã hủy đơn hàng thành công.');
        });
    }

    public function create()
    {
        $trips = Trip::with(['route.startLocation', 'route.endLocation', 'vehicle'])
            ->whereDate('trip_date', '>=', Carbon::today())
            ->orderBy('trip_date', 'asc')
            ->orderBy('departure_time', 'asc')
            ->get();

        return view('staff.bookings.create', compact('trips'));
    }

    public function getTripData($tripId)
    {
        $trip = Trip::with(['pickupPoints', 'vehicle.seats'])->findOrFail($tripId);
        
        $tickets = Ticket::whereHas('booking', function ($q) use ($tripId) {
            $q->where('trip_id', $tripId)->where('status', '!=', 'cancelled');
        })->get();
        
        $seatLocks = SeatLock::where('trip_id', $tripId)
                             ->where('locked_until', '>', now())
                             ->get();

        return response()->json([
            'pickupPoints' => $trip->pickupPoints,
            'seats' => $trip->vehicle ? $trip->vehicle->seats : [],
            'bookedSeats' => $tickets->pluck('seat_id')->toArray(),
            'lockedSeats' => $seatLocks->pluck('seat_id')->toArray(),
            'price' => $trip->price
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'pickup_point_id' => 'required|exists:pickup_points,id',
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'seats' => 'required|array|min:1',
            'seats.*' => 'exists:seats,id'
        ]);

        return DB::transaction(function () use ($request) {
            $tripId = $request->trip_id;
            $seatIds = $request->seats;
            
            // Validate exactly that seats are not booked or locked
            $alreadyBooked = Ticket::whereHas('booking', function ($q) use ($tripId) {
                $q->where('trip_id', $tripId)->where('status', '!=', 'cancelled');
            })->whereIn('seat_id', $seatIds)->exists();

            if ($alreadyBooked) {
                return back()->with('error', 'Một số ghế đã bị đặt. Xin vui lòng chọn ghế khác.')->withInput();
            }

            $alreadyLocked = SeatLock::where('trip_id', $tripId)
                                     ->whereIn('seat_id', $seatIds)
                                     ->where('locked_until', '>', now())
                                     ->exists();

            if ($alreadyLocked) {
                return back()->with('error', 'Một số ghế đang bị khách khác giữ chỗ.')->withInput();
            }

            $trip = Trip::find($tripId);
            $totalAmount = count($seatIds) * $trip->price;

            // Find or create user implicitly
            $user = User::firstOrCreate(
                ['phone' => $request->contact_phone],
                [
                    'name' => $request->contact_name,
                    'email' => 'guest_' . time() . '_' . rand(100,999) . '@bus.test', // Dummy distinct email if required
                    'password' => bcrypt('password123'), // Dummy password
                    'role' => 'customer'
                ]
            );

            // Create Booking
            $booking = Booking::create([
                'user_id' => $user->id,
                'trip_id' => $tripId,
                'pickup_point_id' => $request->pickup_point_id,
                'contact_name' => $request->contact_name,
                'contact_phone' => $request->contact_phone,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'notes' => 'Tạo bởi Staff Offline'
            ]);

            // Create Tickets & Locks
            foreach ($seatIds as $seatId) {
                Ticket::create([
                    'booking_id' => $booking->id,
                    'trip_id' => $tripId, // Missing field before
                    'seat_id' => $seatId,
                    'ticket_code' => strtoupper(uniqid('TK')),
                    'price' => $trip->price,
                    'status' => 'pending'
                ]);

                // Create a hard lock attached to this booking
                SeatLock::create([
                    'trip_id' => $tripId,
                    'seat_id' => $seatId,
                    'user_id' => $user->id,
                    'booking_id' => $booking->id,
                    'locked_until' => now()->addDays(30) // Essentially locked permanently for this trip
                ]);
            }

            StaffLog::create([
                'user_id' => Auth::id(),
                'action' => 'confirm_booking', // or maybe 'create_booking' if you want a new type
                'model_type' => Booking::class,
                'model_id' => $booking->id,
                'description' => "Tạo đơn đặt vé Offline. SĐT khách: {$request->contact_phone}. Số vé: " . count($seatIds),
                'ip_address' => request()->ip(),
            ]);

            return redirect()->route('staff.bookings.show', $booking)->with('success', 'Tạo đơn đặt vé thành công!');
        });
    }
}
