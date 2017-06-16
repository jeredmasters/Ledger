<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class CalendarController extends Controller
{
    public function calendar(Request $request){
        $events = [];

        $bookings = Booking::all();
        foreach($bookings as $booking){
            $events = array_merge($events, $booking->toEvents());
        }
        return view('m.calendar', compact('events'));
    }
}
