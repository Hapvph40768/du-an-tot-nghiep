<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\Route;
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
        return view('admin.parcels.edit', compact('parcel', 'routes'));
    }

    public function update(Request $request, Parcel $parcel)
    {
        $data = $request->validate([
            'sender_name' => 'required|string',
            'sender_phone' => 'required|string',
            'receiver_name' => 'required|string',
            'receiver_phone' => 'required|string',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'route_id' => 'required|exists:routes,id',
            'status' => 'required|in:pending,shipping,completed,cancelled',
        ]);
        $parcel->update($data);
        return redirect()->route('admin.parcels.index')->with('success', 'Cập nhật ký gửi thành công');
    }

    public function destroy(Parcel $parcel)
    {
        $parcel->delete();
        return redirect()->route('admin.parcels.index')->with('success', 'Xóa ký gửi thành công');
    }
}
