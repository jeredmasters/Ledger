<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Booking;
use App\Models\User;
use App\Models\Setting;
use App\Models\Log;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the users
        $logs = Log::orderBy('created_at','DESC')->get();

        foreach($logs as $log){
            $log->item = $this->getItem($log->item_type,$log->item_id);
            $log->user = User::find($log->user_id);
        }

        // load the view and pass the users
        return view('a.log.index')
            ->with('logs', $logs);
    }

    private function getItem($type, $id){
        switch($type){
            case 'booking':
                return Booking::find($id)->name;
            case 'user':
                return User::find($id)->name;
            case 'setting':
                return Setting::find($id)->key;
        }
        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        // get the user
        $log = Log::find($id);

        $log->item = $this->getItem($log->item_type,$log->item_id);
        $log->user = User::find($log->user_id);

        // show the view and pass the user to it
        return view('a.log.show')
            ->with('log', $log);
    }
}
