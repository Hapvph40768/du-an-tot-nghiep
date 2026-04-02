<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Parking;
use App\Models\ParkingSlot;
use App\Models\ParkingHistory;
use App\Models\Vehicle;
use App\Models\StaffLog;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{
    public function index()
    {
        $parkings = Parking::with(['slots.vehicle'])->get();
        return view('staff.parking.index', compact('parkings'));
    }

    public function checkIn(Request $request, ParkingSlot $slot)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id'
        ]);

        if ($slot->status === 'occupied') {
            return back()->with('error', 'Vị trí này đã có xe.');
        }

        $slot->update([
            'vehicle_id' => $request->vehicle_id,
            'status' => 'occupied'
        ]);

        ParkingHistory::create([
            'slot_id' => $slot->id,
            'vehicle_id' => $request->vehicle_id,
            'entry_time' => now(),
            'status' => 'active'
        ]);

        StaffLog::create([
            'user_id' => Auth::id(),
            'action' => 'parking_check_in',
            'model_type' => ParkingSlot::class,
            'model_id' => $slot->id,
            'description' => "Cho xe ID: {$request->vehicle_id} vào vị trí {$slot->slot_code}",
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Đã check-in xe vào bãi.');
    }

    public function checkOut(ParkingSlot $slot)
    {
        if ($slot->status !== 'occupied') {
            return back()->with('error', 'Vị trí này đang trống.');
        }

        $history = ParkingHistory::where('slot_id', $slot->id)
            ->where('vehicle_id', $slot->vehicle_id)
            ->whereNull('exit_time')
            ->first();

        if ($history) {
            $history->update([
                'exit_time' => now(),
                'status' => 'completed'
            ]);
        }

        $oldVehicleId = $slot->vehicle_id;
        $slot->update([
            'vehicle_id' => null,
            'status' => 'available'
        ]);

        StaffLog::create([
            'user_id' => Auth::id(),
            'action' => 'parking_check_out',
            'model_type' => ParkingSlot::class,
            'model_id' => $slot->id,
            'description' => "Cho xe ID: {$oldVehicleId} ra khỏi vị trí {$slot->slot_code}",
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', 'Đã check-out xe khỏi bãi.');
    }
}
