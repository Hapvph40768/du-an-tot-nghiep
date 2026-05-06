<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DropoffPoint;
use App\Models\Location;
use Illuminate\Http\Request;

class DropoffPointController extends Controller
{
    public function index()
    {
        // Thêm sắp xếp theo Tỉnh để Admin dễ quản lý danh mục
        $dropoffPoints = DropoffPoint::with('location')
            ->orderBy('location_id')
            ->orderBy('name')
            ->paginate(20);
            
        return view('admin.dropoff_points.index', compact('dropoffPoints'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('admin.dropoff_points.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        // Kiểm tra tránh trùng lặp điểm trả trong cùng một tỉnh
        $exists = DropoffPoint::where('location_id', $validated['location_id'])
            ->where('name', $validated['name'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['name' => 'Điểm trả này đã tồn tại ở tỉnh này!'])->withInput();
        }

        DropoffPoint::create($validated);
        return redirect()->route('admin.dropoff-points.index')->with('success', 'Đã thêm điểm trả vào danh mục hệ thống!');
    }

    public function edit(DropoffPoint $dropoffPoint)
    {
        $locations = Location::all();
        return view('admin.dropoff_points.edit', compact('dropoffPoint', 'locations'));
    }

    public function update(Request $request, DropoffPoint $dropoffPoint)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        $dropoffPoint->update($validated);
        return redirect()->route('admin.dropoff-points.index')->with('success', 'Cập nhật danh mục điểm trả thành công!');
    }

    public function destroy(DropoffPoint $dropoffPoint)
    {
        // Kiểm tra xem điểm trả này có đang được gán cho chuyến xe nào không trước khi xóa (Nếu cần)
        $dropoffPoint->delete();
        return redirect()->route('admin.dropoff-points.index')->with('success', 'Xóa điểm trả khỏi danh mục thành công!');
    }
}
