<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\Route;
use App\Models\Trip;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    public function index()
    {
        $parcels = Parcel::with('route')->orderByDesc('id')->paginate(10);
        return view('admin.parcels.index', compact('parcels'));
    }

    public function create()
    {
        $routes = Route::all();
        return view('admin.parcels.create', compact('routes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sender_name' => 'required|string',
            'sender_phone' => 'required|string',
            'receiver_name' => 'required|string',
            'receiver_phone' => 'required|string',
            'pickup_point_id' => 'required|exists:pickup_points,id',
            'dropoff_point_id' => 'required|exists:dropoff_points,id',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'route_id' => 'required|exists:routes,id',
            'status' => 'required|in:pending,shipping,completed,cancelled',
        ]);
        Parcel::create($data);
        return redirect()->route('admin.parcels.index')->with('success', 'Thêm ký gửi thành công');
    }

    public function edit(Parcel $parcel)
    {
        $routes = Route::all();
        $trips = Trip::with(['vehicle', 'driver'])->where('route_id', $parcel->route_id)->where('trip_date', '>=', date('Y-m-d'))->get();
        return view('admin.parcels.edit', compact('parcel', 'routes', 'trips'));
    }

    public function update(Request $request, Parcel $parcel)
    {
        if ($parcel->status === 'cancelled') {
            return redirect()->route('admin.parcels.index')->with('error', 'Không thể chỉnh sửa đơn ký gửi đã bị huỷ.');
        }

        $data = $request->validate([
            'sender_name' => 'required|string',
            'sender_phone' => 'required|string',
            'receiver_name' => 'required|string',
            'receiver_phone' => 'required|string',
            'pickup_point_id' => 'required|exists:pickup_points,id',
            'dropoff_point_id' => 'required|exists:dropoff_points,id',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'route_id' => 'required|exists:routes,id',
            'status' => 'required|in:pending,shipping,completed,cancelled',
            'trip_id' => 'nullable|exists:trips,id',
        ]);
        
        // If assigned a trip, automatically update status to shipping if it was pending
        if ($data['trip_id'] && $parcel->status == 'pending' && $data['status'] == 'pending') {
            $data['status'] = 'shipping';
        }

        $parcel->update($data);
        return redirect()->route('admin.parcels.index')->with('success', 'Cập nhật ký gửi thành công');
    }

    public function show(Parcel $parcel)
    {
        $parcel->load('route.departureLocation', 'route.destinationLocation');
        return view('admin.parcels.show', compact('parcel'));
    }

    public function destroy(Parcel $parcel)
    {
        $parcel->delete();
        return redirect()->route('admin.parcels.index')->with('success', 'Xóa ký gửi thành công');
    }
}
