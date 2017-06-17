<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Validator;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the bookings
        $bookings = Booking::all();

        // load the view and pass the bookings
        return view('m.bookings.index')
            ->with('bookings', $bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('m.bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'from'       => 'required',
            'to'       => 'required',
        ]);
        $user = $request->session()->get('user');

        $atLeastOneRoom = $request->get('main') || $request->get('flat') || $request->get('studio');

        // process the login
        if ($validator->fails() || !$atLeastOneRoom) {
            return redirect('/m/bookings/create')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $booking = new Booking;
            $booking->name    = $request->get('name');
            $booking->type    = $request->get('type');
            $booking->from    = $request->get('from') . ' 01:01:01';
            $booking->to      = $request->get('to') . ' 23:59:59';
            $booking->main    = $request->get('main') == 1;
            $booking->flat    = $request->get('flat') == 1;
            $booking->studio  = $request->get('studio') == 1;
            $booking->user_id = $user->id;
            $booking->save();

            // redirect
            $request->session()->flash('message', 'Successfully created booking!');
            return redirect('/m/calendar');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        // get the booking
        $booking = Booking::find($id);

        // show the view and pass the booking to it
        return view('m.bookings.show')
            ->with('booking', $booking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $events = [];

        $bookings = Booking::all();
        foreach($bookings as $booking){
            $events = array_merge($events, $booking->toEvents());
        }

        // get the booking
        $booking = Booking::find($id);

        // show the view and pass the booking to it
        return view('m.bookings.edit')
            ->with('booking', $booking)
            ->with('events', $events);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
        ]);

        // process the login
        if ($validator->fails()) {
            return redirect('/m/bookings/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $booking = Booking::find($id);
            $booking->name    = $request->get('name');
            $booking->type    = $request->get('type');
            $booking->from    = $request->get('from') . ' 01:01:01';
            $booking->to      = $request->get('to') . ' 23:59:59';
            $booking->main    = $request->get('main') == 1;
            $booking->flat    = $request->get('flat') == 1;
            $booking->studio  = $request->get('studio') == 1;
            $booking->save();

            // redirect
            $request->session()->flash('message', 'Successfully updated booking!');
            return redirect('/m/calendar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        // delete
        $booking = Booking::find($id);
        $booking->delete();

        // redirect
        $request->session()->flash('message', 'Successfully deleted the booking!');
        return redirect('/m/calendar');
    }
}
