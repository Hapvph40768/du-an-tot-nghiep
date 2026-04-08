<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParcelPrice;
use App\Models\Route;
use Illuminate\Http\Request;

class ParcelPriceController extends Controller
{
    public function index()
    {
        $prices = ParcelPrice::with('route.departureLocation', 'route.destinationLocation')
            ->orderBy('route_id')
            ->paginate(15);
        
        return view('admin.parcel_prices.index', compact('prices'));
    }

    public function create()
    {
        $routes = Route::with(['departureLocation', 'destinationLocation'])->get();
        return view('admin.parcel_prices.create', compact('routes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'weight_from' => 'required|numeric|min:0',
            'weight_to' => 'required|numeric|gt:weight_from',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        ParcelPrice::create($data);
        return redirect()->route('admin.parcel_prices.index')->with('success', 'Thêm giá ký gửi thành công');
    }

    public function edit(ParcelPrice $parcelPrice)
    {
        $routes = Route::with(['departureLocation', 'destinationLocation'])->get();
        return view('admin.parcel_prices.edit', compact('parcelPrice', 'routes'));
    }

    public function show(ParcelPrice $parcelPrice)
    {
        return view('admin.parcel_prices.show', compact('parcelPrice'));
    }

    public function update(Request $request, ParcelPrice $parcelPrice)
    {
        $data = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'weight_from' => 'required|numeric|min:0',
            'weight_to' => 'required|numeric|gt:weight_from',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $parcelPrice->update($data);
        return redirect()->route('admin.parcel_prices.index')->with('success', 'Cập nhật giá ký gửi thành công');
    }

    public function destroy(ParcelPrice $parcelPrice)
    {
        $parcelPrice->delete();
        return redirect()->route('admin.parcel_prices.index')->with('success', 'Xóa giá ký gửi thành công');
    }
}
