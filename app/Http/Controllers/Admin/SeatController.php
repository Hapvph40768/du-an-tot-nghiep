<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    // Hiển thị danh sách ghế (Có thể lọc theo từng xe)
    public function index(Request $request)
    {
        $query = Seat::with('vehicle')->orderBy('vehicle_id')->orderBy('seat_number');

        // Nếu Admin bấm xem ghế của 1 xe cụ thể (truyền qua URL ?vehicle_id=1)
        if ($request->has('vehicle_id')) {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        $seats = $query->paginate(50);
        $vehicles = Vehicle::where('status', 'active')->get(); // Để làm bộ lọc trên View

        return view('admin.seats.index', compact('seats', 'vehicles'));
    }

    // Form thêm ghế mới thủ công (ví dụ thêm ghế súp/ghế phụ)
    public function create()
    {
        $vehicles = Vehicle::all();
        return view('admin.seats.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'seat_number' => 'required|string|max:20',
        ]);

        // Kiểm tra xem tên ghế này đã tồn tại trên xe này chưa (do bạn có UNIQUE(vehicle_id, seat_number))
        $exists = Seat::where('vehicle_id', $validated['vehicle_id'])
                      ->where('seat_number', $validated['seat_number'])
                      ->exists();

        if ($exists) {
            return back()->with('error', 'Mã ghế này đã tồn tại trên xe được chọn!')->withInput();
        }

        Seat::create($validated);
        
        return redirect()->route('admin.seats.index', ['vehicle_id' => $validated['vehicle_id']])
                         ->with('success', 'Thêm ghế mới thành công!');
    }

    public function edit(Seat $seat)
    {
        $vehicles = Vehicle::all();
        return view('admin.seats.edit', compact('seat', 'vehicles'));
    }

    public function update(Request $request, Seat $seat)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'seat_number' => 'required|string|max:20',
        ]);

        // Kiểm tra trùng lặp (trừ chính cái ghế đang sửa)
        $exists = Seat::where('vehicle_id', $validated['vehicle_id'])
                      ->where('seat_number', $validated['seat_number'])
                      ->where('id', '!=', $seat->id)
                      ->exists();

        if ($exists) {
            return back()->with('error', 'Mã ghế này đã tồn tại trên xe được chọn!')->withInput();
        }

        $seat->update($validated);
        
        return redirect()->route('admin.seats.index', ['vehicle_id' => $seat->vehicle_id])
                         ->with('success', 'Cập nhật thông tin ghế thành công!');
    }

    public function destroy(Seat $seat)
    {
        $vehicleId = $seat->vehicle_id;
        $seat->delete();
        
        return redirect()->route('admin.seats.index', ['vehicle_id' => $vehicleId])
                         ->with('success', 'Xóa ghế thành công!');
    }
}