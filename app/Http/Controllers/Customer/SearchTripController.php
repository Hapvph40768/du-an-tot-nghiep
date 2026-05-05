<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class SearchTripController extends Controller
{

    public function index(Request $request)
    {

        $query = Trip::with(

            'route.startLocation',
            'route.endLocation',
            'vehicle'

        )->where('status','active');

        if($request->start){

            $query->whereHas('route',function($q) use ($request){

                $q->where('start_location_id',$request->start);

            });

        }

        if($request->end){

            $query->whereHas('route',function($q) use ($request){

                $q->where('end_location_id',$request->end);

            });

        }

        if($request->date){

            $query->whereDate('trip_date',$request->date);

        }

        $trips = $query->get();

        return view('customer.trips.index',compact('trips'));

    }

}