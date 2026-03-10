<?php

namespace App\Http\Controllers;

use App\Models\LocationModel;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = LocationModel::orderByDesc('id')->paginate(10);

        return view('admin.location.listLocation', compact('locations'));
    }

    public function create()
    {
        return view('admin.location.addLocation');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        LocationModel::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('locations.index')
            ->with('success', 'Thêm tỉnh/thành thành công.');
    }

    public function show(LocationModel $location)
    {
        return view('admin.location.showLocation', compact('location'));
    }

    public function edit(LocationModel $location)
    {
        return view('admin.location.editLocation', compact('location'));
    }

    public function update(Request $request, LocationModel $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('locations.index')
            ->with('success', 'Cập nhật thành công.');
    }

    public function destroy(LocationModel $location)
    {
        $location->delete();

        return redirect()
            ->route('locations.index')
            ->with('success', 'Xóa thành công.');
    }
}