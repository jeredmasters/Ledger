<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\Models\Setting;
use App\Models\User;
use App\Models\Log;

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
    public function handleProviderCallback(Request $request)
    {
        $fb_user = Socialite::driver('facebook')->user();

        return $this->loginUser($fb_user, $request);
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleJsPush(Request $request)
    {
        $token = $request->input('token');
        $fb_user = Socialite::driver('facebook')->userFromToken($token);
        return $this->loginUser($fb_user, $request);
    }

    private function loginUser($fb_user, $request){

        $user = User::where('oauth_id','=',$fb_user->id)->first();
        $newUser = false;
        if ($user == null){
            $newUser = true;
            $user = new User;
            $user->oauth_id = $fb_user->id;
            $user->access = Setting::get('default_access');
        }
        $user->name = $fb_user->name;
        $user->avatar = $fb_user->avatar;
        $user->email = $fb_user->email;


        $user->save();


        $request->session()->put('user', $user);

        if ($newUser){
            Log::user($user->id, 'create', $user);
        }

        // $user->token;
        return redirect()->route('hello');
    }

    public function logout(Request $request){
        $request->session()->put('user', null);
        return view('logout');
    }
}
