<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\LocationModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $query = LocationModel::query();

        // Tìm kiếm theo tên hoặc địa chỉ
        if ($keyword = $request->input('keyword')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('address', 'like', "%{$keyword}%")
                    ->orWhere('city', 'like', "%{$keyword}%");
            });
        }

        // Lọc theo trạng thái
        if (in_array($request->status, ['active', 'inactive'])) {
            $query->where('is_active', $request->status === 'active');
        }

        $locations = $query->latest()->paginate(15);

        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:150|unique:locations,name',
            'address'      => 'required|string|max:255', 
            'city'         => 'nullable|string|max:100',
            'province_code' => 'nullable|string|max:10',
            'latitude'     => 'nullable|numeric|between:-90,90',
            'longitude'    => 'nullable|numeric|between:-180,180',
            'note'         => 'nullable|string',
        ]);

        LocationModel::create($validated);

        return redirect()->route('admin.locations.index')
            ->with('success', 'Đã thêm địa điểm mới thành công!');
    }

    public function edit(LocationModel $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, LocationModel $location)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('locations')->ignore($location->id),
            ],
            'address'       => 'nullable|string|max:255',
            'city'          => 'nullable|string|max:100',
            'province_code' => 'nullable|string|max:10',
            'latitude'      => 'nullable|numeric|between:-90,90',
            'longitude'     => 'nullable|numeric|between:-180,180',
            'note'          => 'nullable|string',
            'is_active'     => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $location->update($validated);

        return redirect()->route('admin.locations.index')
            ->with('success', 'Đã cập nhật địa điểm thành công!');
    }

    public function destroy(LocationModel $location)
    {

        $location->delete();

        return redirect()->route('admin.locations.index')
            ->with('success', 'Đã xóa địa điểm thành công!');
    }
}
