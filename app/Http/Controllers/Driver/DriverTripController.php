<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverTripController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $driver = $user->driver;

        if (!$driver) {
            return redirect()->route('driver.home')
                ->with('error', 'Bạn không phải tài xế hoặc chưa được gán tài khoản tài xế.');
        }

        $trips = Trip::with([
            'route.departureLocation',
            'route.destinationLocation',
            'vehicle',
            'pickupPoints'
        ])
            ->where('driver_id', $driver->id)
            ->whereIn('status', ['active', 'running'])
            ->orderBy('trip_date', 'asc')
            ->orderBy('departure_time', 'asc')
            ->paginate(12);

        return view('driver.trips.index', compact('trips'));
    }

    public function show(Trip $trip)
    {
        $trip->load([
            'route.departureLocation',
            'route.destinationLocation',
            'vehicle',
            'pickupPoints',
            'tickets' => function ($query) {
                $query->where('status', '!=', 'cancelled')
                    ->with(['seat', 'booking.user']);  
            },
            'bookings.user'   
        ]);

        return view('driver.trips.show', compact('trip'));
    }

    public function updateStatus(Trip $trip, Request $request)
    {
        $request->validate([
            'status' => 'required|in:running,completed,broken',
        ]);

        // Đảm bảo chuyến có thể được cập nhật (ví dụ ko bị huỷ, hoặc check logic khác)
        if ($trip->status === 'cancelled') {
            return back()->with('error', 'Chuyến xe đã bị hủy, không thể cập nhật.');
        }

        $trip->update(['status' => $request->status]);

        $message = 'Đã cập nhật trạng thái chuyến xe.';
        if ($request->status === 'running') $message = 'Chuyến xe đã bắt đầu!';
        elseif ($request->status === 'completed') $message = 'Đã hoàn thành chuyến xe!';
        elseif ($request->status === 'broken') $message = 'Đã cập nhật sự cố xe hỏng.';

        return redirect()->route('driver.trips.show', $trip)->with('success', $message);
    }

    public function history()
    {
        $user = Auth::user();
        $driver = $user->driver;

        if (!$driver) {
            return redirect()->route('driver.home')->with('error', 'Bạn không phải tài xế.');
        }

        $trips = Trip::with([
            'route.departureLocation',
            'route.destinationLocation',
            'vehicle',
            'pickupPoints'
        ])
            ->where('driver_id', $driver->id)
            ->whereIn('status', ['completed', 'cancelled', 'broken'])
            ->orderBy('trip_date', 'desc')
            ->orderBy('departure_time', 'desc')
            ->paginate(12);

        return view('driver.trips.history', compact('trips'));
    }

    public function revenue()
    {
        $user = Auth::user();
        $driver = $user->driver;

        if (!$driver) {
            return redirect()->route('driver.home')->with('error', 'Bạn không phải tài xế.');
        }

        // Doanh thu có thể lấy từ tổng các booking đã thanh toán thuộc các chuyến đi của tài xế này
        $trips = Trip::with(['bookings' => function($q) {
                $q->where('status', 'paid');
            }])
            ->where('driver_id', $driver->id)
            ->whereIn('status', ['completed', 'running'])
            ->orderBy('trip_date', 'desc')
            ->get();

        $totalRevenue = 0;
        $tripStats = [];

        foreach ($trips as $trip) {
            $sum = $trip->bookings->sum('total_amount');
            $totalRevenue += $sum;
            $tripStats[] = [
                'trip' => $trip,
                'revenue' => $sum,
                'bookings_count' => $trip->bookings->count()
            ];
        }

        return view('driver.revenue.index', compact('totalRevenue', 'tripStats', 'trips'));
    }
}
