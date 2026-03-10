<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PickupPoint;
use App\Models\Location;

class PickupPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $points = PickupPoint::with('location')->latest()->paginate(10);

        return view('admin.pickup_points.index', compact('points'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        return view('admin.pickup_points.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PickupPoint::create([
            'name' => $request->name,
            'address' => $request->address,
            'location_id' => $request->location_id
        ]);

        return redirect()->route('admin.pickup-points.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $point = PickupPoint::findOrFail($id);
        $locations = Location::all();

        return view('admin.pickup_points.edit', compact('point', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $point = PickupPoint::findOrFail($id);

        $point->update($request->all());

        return redirect()
            ->route('admin.pickup-points.index')
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        PickupPoint::destroy($id);

        return redirect()
            ->back()
            ->with('success', 'Xóa thành công');
    }
}
