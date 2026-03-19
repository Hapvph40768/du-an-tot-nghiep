<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Location;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy danh sách địa điểm cho form tìm kiếm chuyến xe
        $locations = Location::orderBy('name', 'asc')->get();
        
        return view('customer.home.index', compact('locations'));
    }
}