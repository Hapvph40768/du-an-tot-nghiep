<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Location;

class HomeController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('name', 'asc')->get();
        
        return view('customer.home.index', compact('locations'));
    }
}