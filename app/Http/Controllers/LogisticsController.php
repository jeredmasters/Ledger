<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class LogisticsController extends Controller
{
    public function calendar(Request $request){
        $events = [];

        $events[] = \Calendar::event(
            'Event One', //event title
            false, //full day event?
            '2017-06-15T0800', //start time (you can also use Carbon instead of DateTime)
            '2017-06-17T0800', //end time (you can also use Carbon instead of DateTime)
        	0 //optionally, you can specify an event ID
        );

        $events[] = \Calendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            new \DateTime('2017-06-14'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2017-06-14'), //end time (you can also use Carbon instead of DateTime)
        	'stringEventId' //optionally, you can specify an event ID
        );

        //$eloquentEvent = Booking::first(); //EventModel implements MaddHatter\LaravelFullcalendar\Event

        $calendar = \Calendar::addEvents($events); //add an array with addEvents
            // ->addEvent($eloquentEvent, [ //set custom color fo this event
            //     'color' => '#800',
            // ])->setOptions([ //set fullcalendar options
        	// 	'firstDay' => 1
        	// ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            //     'viewRender' => 'function() {alert("Callbacks!");}'
            // ]);

        return view('calendar', compact('calendar'));
    }
}
