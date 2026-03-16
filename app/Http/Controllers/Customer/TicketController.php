<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function index()
    {

        $tickets = Ticket::whereHas(
            'booking',
            fn($q)=>$q->where('user_id',Auth::id())
        )->with('trip')->get();

        return view('customer.tickets.index',compact('tickets'));

    }

}