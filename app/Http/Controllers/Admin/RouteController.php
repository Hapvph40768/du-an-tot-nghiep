<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::with(['startLocation', 'endLocation'])->paginate(10);
        return view('admin.routes.index', compact('routes'));
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