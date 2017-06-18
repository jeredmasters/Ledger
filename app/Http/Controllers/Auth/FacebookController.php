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
        if ($user == null){
            $user = new User;
            $user->oauth_id = $fb_user->id;
            $user->access = (count(User::all()) == 0 ? 3 : 2);
        }
        $user->name = $fb_user->name;
        $user->avatar = $fb_user->avatar;
        $user->email = $fb_user->email;


        $user->save();

        $request->session()->put('user', $user);
        // $user->token;
        return redirect()->route('hello');
    }

    public function logout(Request $request){
        $request->session()->put('user', null);
        return view('logout');
    }
}
