<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Location;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::with(['startLocation', 'endLocation'])->paginate(10);
        return view('admin.routes.index', compact('routes'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('admin.routes.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_location_id' => 'required|exists:locations,id',
            'end_location_id' => 'required|exists:locations,id|different:start_location_id',
            'distance_km' => 'required|integer|min:1',
            'estimated_time' => 'required|integer|min:1'
        ]);

        Route::create($validated);

        return redirect()->route('routes.index')->with('success', 'Tuyến xe được tạo thành công!');
    }

    public function show(Route $route)
    {
        $route->load(['startLocation', 'endLocation']);
        return view('admin.routes.show', compact('route'));
    }

    public function edit(Route $route)
    {
        $locations = Location::all();
        return view('admin.routes.edit', compact('route', 'locations'));
    }

    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'start_location_id' => 'required|exists:locations,id',
            'end_location_id' => 'required|exists:locations,id|different:start_location_id',
            'distance_km' => 'required|integer|min:1',
            'estimated_time' => 'required|integer|min:1'
        ]);

        $route->update($validated);

        return redirect()->route('routes.index')->with('success', 'Tuyến xe được cập nhật thành công!');
    }

    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('routes.index')->with('success', 'Tuyến xe được xóa thành công!');
    }
}