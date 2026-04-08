<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = \App\Models\Route::with(['departureLocation', 'destinationLocation'])->latest()->paginate(10);
        return view('admin.routes.index', compact('routes'));
    }

    public function show(\App\Models\Route $route)
    {
        $route->load(['departureLocation', 'destinationLocation']);
        return view('admin.routes.show', compact('route'));
    }

    public function create()
    {
        $locations = Location::all(); // Lấy danh sách địa điểm để chọn điểm đi/đến
        return view('admin.routes.create', compact('locations'));
    }

    public function edit(\App\Models\Route $route)
    {
        $locations = Location::all();
        return view('admin.routes.edit', compact('route', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_location_id' => 'required|exists:locations,id',
            'end_location_id' => 'required|exists:locations,id|different:start_location_id',
            'distance_km' => 'nullable|integer|min:1',
            'estimated_time' => 'nullable|integer|min:1',
        ]);

        Route::create($validated);
        return redirect()->route('admin.routes.index')->with('success', 'Tạo tuyến đường thành công');
    }

    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'start_location_id' => 'required|exists:locations,id',
            'end_location_id' => 'required|exists:locations,id|different:start_location_id',
            'distance_km' => 'nullable|integer|min:1',
            'estimated_time' => 'nullable|integer|min:1',
        ]);

        $route->update($validated);
        return redirect()->route('admin.routes.index')->with('success', 'Cập nhật tuyến đường thành công');
    }

    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('admin.routes.index')->with('success', 'Xóa tuyến đường thành công');
    }
}
