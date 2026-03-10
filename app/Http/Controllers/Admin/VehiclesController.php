<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehiclesController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicles::query();

        if ($keyword = $request->input('keyword')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('license_plate', 'like', "%{$keyword}%")
                    ->orWhere('type', 'like', "%{$keyword}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $vehicles = $query->orderBy('id', 'desc')->paginate(15);

        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => ['required', 'string', 'max:20', 'unique:vehicles,license_plate'],
            'type'          => ['nullable', 'string', 'max:100'],
            'total_seats'   => ['required', 'integer', 'min:2', 'max:100'],
            'status'        => ['required', Rule::in(['active', 'maintenance'])],
        ]);

        Vehicles::create($validated);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Thêm xe mới thành công!');
    }

    public function edit(Vehicles $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicles $vehicle)
    {
        $validated = $request->validate([
            'license_plate' => ['required', 'string', 'max:20', Rule::unique('vehicles')->ignore($vehicle->id)],
            'type'          => ['nullable', 'string', 'max:100'],
            'total_seats'   => ['required', 'integer', 'min:2', 'max:100'],
            'status'        => ['required', Rule::in(['active', 'maintenance'])],
        ]);

        $vehicle->update($validated);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Cập nhật thông tin xe thành công!');
    }

    public function destroy(Vehicles $vehicle)
    {
        $vehicle->delete();

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Đã xóa xe thành công!');
    }
}
