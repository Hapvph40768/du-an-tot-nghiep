<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Trip;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        $driver = $user->driver;

        $todayTrips = collect();

        if ($driver) {
            $todayTrips = Trip::with([
                'route.departureLocation', 
                'route.destinationLocation', 
                'vehicle', 
                'tickets' => function ($query) {
                    $query->where('status', '!=', 'cancelled');
                }
            ])
            ->where('driver_id', $driver->id)
            ->whereDate('trip_date', Carbon::today())
            ->whereIn('status', ['active', 'running'])
            ->orderBy('departure_time', 'asc')
            ->get();
        }

        return view('driver.home.home', compact('todayTrips'));
    }

    public function profile()
    {
        return view('driver.profile.profile');
    }

    public function editProfile()
    {
        return view('driver.profile.edit');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'license_number' => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0',
            'personal_info' => 'nullable|string',
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();
        
        // Update User
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        // Update or Create Driver record
        \App\Models\Driver::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $request->name,
                'phone' => $request->phone,
                'license_number' => $request->license_number,
                'experience_years' => $request->experience_years,
                'personal_info' => $request->personal_info,
            ]
        );

        return redirect()->route('driver.profile')->with('success', 'Thông tin hồ sơ đã được cập nhật!');
    }
}
