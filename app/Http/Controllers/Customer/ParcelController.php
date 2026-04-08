<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\Route as TripRoute;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    public function create()
    {
        $routes = TripRoute::with(['departureLocation', 'destinationLocation'])->get();

        return view('customer.parcels.create', compact('routes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_phone' => 'required|string|max:50',
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:50',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'route_id' => 'required|exists:routes,id',
        ]);

        Parcel::create($data);

        return redirect()->route('customer.parcels.create')->with('success', 'Yêu cầu ký gửi hàng đã gửi thành công. Chúng tôi sẽ liên hệ bạn sớm.');
    }
}
