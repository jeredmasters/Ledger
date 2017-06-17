<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // $user->token;
        return response()->json($user);
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleJsPush(Request $request)
    {
        $token = $request->input('token');
        $auth = Socialite::driver('facebook')->userFromToken($token);

        $user = User::where('oauth_id','=',$auth->id)->first();
        if ($user == null){
            $user = new User;
            $user->oauth_id = $auth->id;
            $user->access = 2;
        }
        $user->name = $auth->name;
        $user->avatar = $auth->avatar;
        $user->email = $auth->email;


        $user->save();

        $request->session()->put('user', $user);
        // $user->token;
        return redirect()->route('calendar');
    }
}
