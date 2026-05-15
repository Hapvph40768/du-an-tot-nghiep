<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.drivers.index', compact('drivers'));
    }

    public function show(Driver $driver)
    {
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
            'name'                 => 'required|string|max:255',
            'date_of_birth'        => 'nullable|date',
            'gender'               => 'nullable|in:male,female,other',
            'phone'                => 'nullable|string|max:50|unique:drivers,phone',
            'email'                => 'required|email|max:255|unique:users,email',
            'address'              => 'nullable|string',
            'avatar'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'id_card_number'       => 'nullable|string|max:20',
            'license_number'       => 'nullable|string|max:50|unique:drivers,license_number',
            'license_class'        => 'nullable|string|max:10',
            'license_issued_date'  => 'nullable|date',
            'license_expiry_date'  => 'nullable|date|after_or_equal:license_issued_date',
            'license_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'experience_years'     => 'nullable|integer|min:0',
            'personal_info'        => 'nullable|string',
            'status'               => 'required|in:active,inactive',
        ]);

        // Tạo User account cho tài xế
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'] ?? null,
            'password' => Hash::make($validated['email']),
            'role'     => 'driver',
            'email_verified_at' => now(),
        ]);

        // Upload ảnh đại diện
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('drivers/avatars', 'public');
        }

        // Upload ảnh bằng lái
        if ($request->hasFile('license_image')) {
            $validated['license_image'] = $request->file('license_image')->store('drivers/licenses', 'public');
        }

        $driverData = collect($validated)->except('email')->toArray();
        $driverData['user_id'] = $user->id;

        Driver::create($driverData);

        return redirect()->route('admin.drivers.index')->with('success', 'Thêm tài xế thành công!');
    }

    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'date_of_birth'        => 'nullable|date',
            'gender'               => 'nullable|in:male,female,other',
            'phone'                => 'nullable|string|max:50|unique:drivers,phone,' . $driver->id,
            'address'              => 'nullable|string',
            'avatar'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'id_card_number'       => 'nullable|string|max:20',
            'license_number'       => 'nullable|string|max:50|unique:drivers,license_number,' . $driver->id,
            'license_class'        => 'nullable|string|max:10',
            'license_issued_date'  => 'nullable|date',
            'license_expiry_date'  => 'nullable|date|after_or_equal:license_issued_date',
            'license_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'experience_years'     => 'nullable|integer|min:0',
            'personal_info'        => 'nullable|string',
            'status'               => 'required|in:active,inactive',
        ]);

        // Upload ảnh đại diện mới (xóa cũ nếu có)
        if ($request->hasFile('avatar')) {
            if ($driver->avatar) Storage::disk('public')->delete($driver->avatar);
            $validated['avatar'] = $request->file('avatar')->store('drivers/avatars', 'public');
        }

        // Upload ảnh bằng lái mới
        if ($request->hasFile('license_image')) {
            if ($driver->license_image) Storage::disk('public')->delete($driver->license_image);
            $validated['license_image'] = $request->file('license_image')->store('drivers/licenses', 'public');
        }

        $driver->update($validated);

        // Đồng bộ tên lên User
        if ($driver->user) {
            $driver->user->update(['name' => $validated['name']]);
        }

        return redirect()->route('admin.drivers.index')->with('success', 'Cập nhật tài xế thành công!');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->avatar) Storage::disk('public')->delete($driver->avatar);
        if ($driver->license_image) Storage::disk('public')->delete($driver->license_image);
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'Xóa tài xế thành công!');
    }
}
