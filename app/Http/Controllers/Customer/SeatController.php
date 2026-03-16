<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\SeatLock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeatController extends Controller
{

    public function lock(Request $request)
    {

        $lock = SeatLock::create([

            'trip_id'=>$request->trip_id,

            'seat_id'=>$request->seat_id,

            'user_id'=>Auth::id(),

            'locked_until'=>now()->addMinutes(5)

        ]);

        return response()->json($lock);

    }
}