<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    /**
     * Hiển thị danh sách tài xế
     */
    public function index()
    {
        $drivers = Driver::latest()->paginate(10);
        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Hiển thị form thêm tài xế mới
     */
    public function create()
    {
        return view('admin.drivers.create');
    }

    /**
     * Xử lý lưu tài xế mới vào Database
     */
    public function store(Request $request)
    {
        // 1. Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:drivers',
            'license_number' => 'required|string|max:50|unique:drivers',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'personal_info' => 'nullable|string',
            'status' => 'required|in:active,busy,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Xử lý upload ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('drivers', 'public');
            $validatedData['image'] = 'storage/' . $imagePath;
        }

        // 3. Lưu vào Database
        Driver::create($validatedData);

        return redirect()->route('admin.drivers.index')->with('success', 'Đã thêm tài xế thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa tài xế
     */
    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('admin.drivers.edit', compact('driver'));
    }

    /**
     * Xử lý cập nhật thông tin tài xế
     */
    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        // 1. Validate dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:drivers,phone,' . $driver->id,
            'license_number' => 'required|string|max:50|unique:drivers,license_number,' . $driver->id,
            'experience_years' => 'nullable|integer|min:0|max:50',
            'personal_info' => 'nullable|string',
            'status' => 'required|in:active,busy,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Xử lý upload ảnh mới (nếu có)
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có trong storage
            if ($driver->image && Storage::disk('public')->exists(str_replace('storage/', '', $driver->image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $driver->image));
            }

            $imagePath = $request->file('image')->store('drivers', 'public');
            $validatedData['image'] = 'storage/' . $imagePath;
        }

        // 3. Cập nhật Database
        $driver->update($validatedData);

        return redirect()->route('admin.drivers.index')->with('success', 'Cập nhật tài xế thành công!');
    }

    /**
     * Xóa tài xế
     */
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);

        // Xóa ảnh đính kèm (nếu có)
        if ($driver->image && Storage::disk('public')->exists(str_replace('storage/', '', $driver->image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $driver->image));
        }

        $driver->delete();

        return redirect()->route('admin.drivers.index')->with('success', 'Đã xóa tài xế thành công!');
    }
}
