<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Driver;
use Illuminate\Http\Request;

class TripController extends Controller
{
    // 1. Danh sách chuyến xe
    public function index(Request $request)
    {
        $query = Trip::with('driver');

        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('departure_location', 'like', '%' . $request->keyword . '%')
                  ->orWhere('destination_location', 'like', '%' . $request->keyword . '%');
        }

        $trips = $query->latest()->paginate(10)->withQueryString();
        
        return view('admin.trips.index', compact('trips'));
    }

    // 2. Form thêm chuyến xe
    public function create()
    {
        // Lấy danh sách tài xế rảnh để gán cho chuyến xe
        $drivers = Driver::where('status', 'active')->get();
        return view('admin.trips.create', compact('drivers'));
    }

    // 3. Lưu chuyến xe mới
    public function store(Request $request)
    {
        $request->validate([
            'departure_location' => 'required|string|max:255',
            'destination_location' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'departure_time' => 'required',
            'price' => 'required|numeric|min:0',
            'driver_id' => 'nullable|exists:drivers,id',
            'status' => 'required|in:pending,running,completed,cancelled',
        ], [
            'departure_location.required' => 'Vui lòng nhập điểm đi.',
            'destination_location.required' => 'Vui lòng nhập điểm đến.',
            'price.numeric' => 'Giá vé phải là số.',
        ]);

        Trip::create($request->all());

        return redirect()->route('trips.index')->with('success', 'Thêm chuyến xe thành công!');
    }

    // 4. Form sửa chuyến xe
    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        // Lấy tài xế rảnh HOẶC tài xế đang giữ chuyến này
        $drivers = Driver::where('status', 'active')->orWhere('id', $trip->driver_id)->get();
        
        return view('admin.trips.edit', compact('trip', 'drivers'));
    }

    // 5. Cập nhật chuyến xe
    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);

        $request->validate([
            'departure_location' => 'required|string|max:255',
            'destination_location' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'departure_time' => 'required',
            'price' => 'required|numeric|min:0',
            'driver_id' => 'nullable|exists:drivers,id',
            'status' => 'required|in:pending,running,completed,cancelled',
        ]);

        $trip->update($request->all());

        return redirect()->route('trips.index')->with('success', 'Cập nhật chuyến xe thành công!');
    }

    // 6. Xóa chuyến xe
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return redirect()->route('trips.index')->with('success', 'Đã xóa chuyến xe.');
    }
}