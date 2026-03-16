<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('admin.locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:locations,name'
        ]);

        Location::create($validated);
        return redirect()->route('admin.locations.index')->with('success', 'Thêm địa điểm thành công');
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:locations,name,' . $location->id
        ]);

        $location->update($validated);
        return redirect()->route('admin.locations.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Xóa địa điểm thành công');
    }
}