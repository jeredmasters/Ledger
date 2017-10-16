<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Validator;
use App\Models\Log;

class BookingsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->json(Booking::active()->get());
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
        $user = $this->user();

        $atLeastOneRoom = $request->get('main') || $request->get('flat') || $request->get('studio');

        // process the login
        if ($validator->fails() || !$atLeastOneRoom) {
            return $this->json($request->all(), $validator);
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
            Log::booking($booking->id, 'create', $booking);

            // redirect
            return $this->json($booking);
        }
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
            return $this->json($request->all(), $validator);
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
            Log::booking($booking->id, 'update', $booking);

            // redirect
            $request->session()->flash('message', 'Successfully updated booking!');
            return $this->json($booking);
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
        Log::booking($id, 'delete');

        // delete
        $booking = Booking::find($id);
        $booking->active = false;
        $booking->save();

        // redirect
        return $this->json("Deleted Successfully");
    }
}
