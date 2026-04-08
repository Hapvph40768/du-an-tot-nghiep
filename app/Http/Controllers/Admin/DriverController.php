<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.drivers.index', compact('drivers'));
    }
    public function show(Driver $driver)
    {
        // Load thêm các chuyến xe nếu bạn có quan hệ 'trips' trong Model Driver
        $driver->load('trips.route');
        return view('admin.drivers.show', compact('driver'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50|unique:drivers,phone',
            'license_number' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'personal_info' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['email']), 
            'role' => 'driver',
            'status' => $validated['status'],
        ]);

        $driverData = collect($validated)->except('email')->toArray();
        $driverData['user_id'] = $user->id; 

        Driver::create($driverData);

        return redirect()->route('admin.drivers.index')
            ->with('success', 'Thêm tài xế thành công!');
    }

    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50|unique:drivers,phone,' . $driver->id,
            'license_number' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'personal_info' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $driver->update($validated);
        return redirect()->route('admin.drivers.index')->with('success', 'Cập nhật tài xế thành công!');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'Xóa tài xế thành công!');
    }
}
