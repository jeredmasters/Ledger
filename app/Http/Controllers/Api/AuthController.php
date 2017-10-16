<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Socialite;
use App\Models\Setting;
use App\Models\User;
use App\Models\Log;
use App\Models\ApiSession;

class AuthController extends BaseController
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function login(Request $request)
    {
      $profile = $request->input('profile');
      $user = $this->getUser($profile);
      $session = ApiSession::create($user);

      return response()->json([
        'user' => $user,
        'token' => $session->token
        ]);
    }

    private function getUser($profile){
        $fb_id = $profile['id'];
        $user = User::where('oauth_id','=',$fb_id)->first();
        $newUser = false;
        if ($user == null){
            $newUser = true;
            $user = new User;
            $user->oauth_id = $fb_id;
            $user->access = Setting::get('default_access');
        }
        $user->name = $profile['name'];
        $user->avatar = "https://graph.facebook.com/v2.9/$fb_id/picture?type=large";
        $user->email = $profile['email'];


        $user->save();

        

        if ($newUser){
            Log::user($user->id, 'create', $user);
        }

        // $user->token;
        return $user;
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function logout(Request $request)
    {

    }

    public function whoami(Request $request){
      return response()->json([
        'user' => $this->user()
        ]);
    }
}
