<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\TripStopover;
use Illuminate\Http\Request;

class TripStopoverController extends Controller
{
    public function store(Request $request, Trip $trip)
    {
        $request->validate([
            'stop_name' => 'required|string|max:255',
            'arrival_time' => 'nullable|date_format:H:i',
            'departure_time' => 'nullable|date_format:H:i',
            'stop_order' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255',
        ]);

        $trip->stopovers()->create($request->all());

        return redirect()->route('admin.trips.show', $trip->id)->with('success', 'Thêm điểm dừng thành công');
    }

    public function update(Request $request, TripStopover $stopover)
    {
        $request->validate([
            'stop_name' => 'required|string|max:255',
            'arrival_time' => 'nullable|date_format:H:i:s,H:i', // Accept both format
            'departure_time' => 'nullable|date_format:H:i:s,H:i',
            'stop_order' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255',
        ]);

        // Fix time format to H:i if passed as H:i:s
        $data = $request->all();
        if (isset($data['arrival_time']) && strlen($data['arrival_time']) > 5) {
            $data['arrival_time'] = substr($data['arrival_time'], 0, 5);
        }
        if (isset($data['departure_time']) && strlen($data['departure_time']) > 5) {
            $data['departure_time'] = substr($data['departure_time'], 0, 5);
        }

        $stopover->update($data);

        return redirect()->route('admin.trips.show', $stopover->trip_id)->with('success', 'Cập nhật điểm dừng thành công');
    }

    public function destroy(TripStopover $stopover)
    {
        $trip_id = $stopover->trip_id;
        $stopover->delete();

        return redirect()->route('admin.trips.show', $trip_id)->with('success', 'Xóa điểm dừng thành công');
    }
}
