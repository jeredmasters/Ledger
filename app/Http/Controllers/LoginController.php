<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function check(Request $request){
        $password = $request->input('password');
        Log::info($password);
        if ($password == '1234'){
            $request->session()->put('authenticated', true) ;
            return redirect()->route('calendar');
        }
        return redirect()->route('welcome');
    }
}
