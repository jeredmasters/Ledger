<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Models\Log;
use App\Models\Setting;

class SettingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the users
        $settings = Setting::all();

        // load the view and pass the users
        return view('a.settings.index')
            ->with('settings', $settings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $key = $request->get('key');
        $value = $request->get('value');
        $id = Setting::set($key,$value);
        Log::setting($id,[$key,$value]);
        return redirect('/a/settings');
    }
}
