<?php

namespace App\Http\Controllers;

use App\Models\PackageBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    //
    public function my_booking(){
       return view('dashboard.my_booking');
    }

    public function booking_details(PackageBooking $packageBooking){
        return view('dashboard.booking_details', compact('packageBooking'));
    }
}
