<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\Route as TripRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParcelController extends Controller
{
    public function index()
    {
        $parcels = Parcel::with('route')
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();

        return view('customer.parcels.index', compact('parcels'));
    }

    public function create()
    {
        $routes = TripRoute::with(['departureLocation', 'destinationLocation'])->get();

        return view('customer.parcels.create', compact('routes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_phone' => 'required|string|max:20',
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0.1',
            'route_id' => 'required|exists:routes,id',
        ]);

        $pricePerKg = 10000;
        $data['price'] = max(20000, $data['weight'] * $pricePerKg);
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        Parcel::create($data);

        return redirect()->route('customer.parcels.index')
                         ->with('success', 'Đã tạo yêu cầu ký gửi hàng hóa thành công. Vui lòng mang hàng ra bến xe và thanh toán.');
    }
}
