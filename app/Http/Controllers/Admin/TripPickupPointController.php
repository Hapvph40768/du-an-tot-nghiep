<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripPickupPointController extends Controller
{

    public function store(Request $request, $tripId)
    {
        $trip = Trip::findOrFail($tripId);

        DB::transaction(function () use ($request, $trip) {

            $syncData = [];

            foreach ($request->pickup_points ?? [] as $pointId => $data) {

                if (!isset($data['pickup_point_id'])) {
                    continue;
                }

                $syncData[$pointId] = [
                    'pickup_time' => $data['pickup_time'] ?? null,
                    'order' => $data['order'] ?? 0,
                ];
            }

            $trip->pickupPoints()->sync($syncData);
        });

        return redirect()->back()->with('success', 'Cập nhật điểm đón thành công');
    }
}
