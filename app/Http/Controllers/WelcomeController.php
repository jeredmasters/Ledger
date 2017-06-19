<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class WelcomeController extends Controller
{
    public function welcome(Request $request){
        return view('welcome');
    }
    public function hello(Request $request){

        $date = new \DateTime;

        $thisWeekendAvailable = false;
        $nextWeekendAvailable = false;

        // Check this weekend
        while($date->format('D') != 'Sat'){
            $date->add(new \DateInterval('P1D'));
        }
        $bookings = Booking::bookings($date);
        $thisWeekendAvailable = count($bookings) == 0;
        $thisWeekend = $date->format('d/m/Y');

        // Next Weekend
        $date->add(new \DateInterval('P7D'));
        $bookings = Booking::bookings($date);
        $nextWeekendAvailable = count($bookings) == 0;
        $nextWeekend = $date->format('d/m/Y');

        return view('m.hello', [
            'user' => session('user'),
            'thisWeekend' => $thisWeekend,
            'nextWeekend' => $nextWeekend,
            'thisWeekendAvailable' => $thisWeekendAvailable,
            'nextWeekendAvailable' => $nextWeekendAvailable
        ]);
    }
}
