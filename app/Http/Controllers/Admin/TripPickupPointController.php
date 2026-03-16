<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripPickupPointController extends Controller
{

    public function store(Request $request)
    {

        $trip = Trip::findOrFail($request->trip_id);

        $trip->pickupPoints()->attach($request->pickup_point_id);

        return back();

    }

    public function destroy($trip,$point)
    {

        $trip = Trip::findOrFail($trip);

        $trip->pickupPoints()->detach($point);

        return back();

    }

}