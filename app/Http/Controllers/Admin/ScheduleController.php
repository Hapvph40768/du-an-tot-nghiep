<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Route;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('route')->orderByDesc('id')->paginate(10);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $routes = Route::all();
        return view('admin.schedules.create', compact('routes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required|date_format:H:i',
            'days_of_week' => 'required|array',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->has('is_active');
        Schedule::create($data);
        return redirect()->route('admin.schedules.index')->with('success', 'Thêm lịch trình xe chạy thành công');
    }

    public function edit(Schedule $schedule)
    {
        $routes = Route::all();
        return view('admin.schedules.edit', compact('schedule', 'routes'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required',
            'days_of_week' => 'required|array',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->has('is_active');
        $schedule->update($data);
        return redirect()->route('admin.schedules.index')->with('success', 'Cập nhật lịch trình xe chạy thành công');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Xóa lịch trình xe chạy thành công');
    }
}
