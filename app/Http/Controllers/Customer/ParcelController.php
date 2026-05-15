<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\Route as TripRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\NewParcelNotification;
use Illuminate\Support\Facades\Notification;

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
            'pickup_point_id' => [
                'required',
                \Illuminate\Validation\Rule::exists('pickup_points', 'id')
                    ->where(function ($query) use ($request) {
                        $route = TripRoute::find($request->route_id);
                        if ($route) {
                            $query->where('location_id', $route->start_location_id);
                        }
                    })
            ],
            'dropoff_point_id' => [
                'required',
                \Illuminate\Validation\Rule::exists('dropoff_points', 'id')
                    ->where(function ($query) use ($request) {
                        $route = TripRoute::find($request->route_id);
                        if ($route) {
                            $query->where('location_id', $route->end_location_id);
                        }
                    })
            ],
        ], [
            'pickup_point_id.exists' => 'Điểm nhận hàng không hợp lệ cho tuyến đường này.',
            'dropoff_point_id.exists' => 'Điểm trả hàng không hợp lệ cho tuyến đường này.',
        ]);

        $pricePerKg = 10000;
        $data['price'] = max(20000, $data['weight'] * $pricePerKg);
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        $parcel = Parcel::create($data);

        // Send notification to admin/staff
        $admins = User::whereIn('role', ['admin', 'staff'])->get();
        Notification::send($admins, new NewParcelNotification($parcel));

        return redirect()->route('customer.parcels.index')
            ->with('parcel_success', true)
            ->with('success', 'Đã tạo yêu cầu ký gửi hàng hóa thành công.');
    }

    public function show(Parcel $parcel)
    {
        if ($parcel->user_id !== Auth::id()) {
            abort(403);
        }
        $parcel->load('route.departureLocation', 'route.destinationLocation', 'trip.vehicle', 'trip.driver');
        return view('customer.parcels.show', compact('parcel'));
    }

    public function cancel(Parcel $parcel)
    {
        if ($parcel->user_id !== Auth::id()) {
            abort(403);
        }

        if ($parcel->status !== 'pending') {
            return back()->with('error', 'Chỉ có thể huỷ đơn ký gửi khi đơn hàng đang ở trạng thái chờ xử lý.');
        }

        $parcel->update(['status' => 'cancelled']);

        return back()->with('success', 'Đã huỷ đơn ký gửi thành công.');
    }

    public function getPointsByRoute(TripRoute $route)
    {
        $pickupPoints = \App\Models\PickupPoint::where('location_id', $route->start_location_id)->get();
        $dropoffPoints = \App\Models\DropoffPoint::where('location_id', $route->end_location_id)->get();

        return response()->json([
            'pickup_points' => $pickupPoints,
            'dropoff_points' => $dropoffPoints
        ]);
    }
}
