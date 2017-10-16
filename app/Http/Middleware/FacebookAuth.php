<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\ApiSession;


class FacebookAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level = 1)
    {
        $headers = getallheaders();
        $token = $headers['Token'];

        $session = ApiSession::token($token);
        if ($session !== null){
          

          $user = User::find($session->user_id);

          if ($user !== null){
              $GLOBALS['session'] = $session;
              $GLOBALS['user'] = $user;

              if ($user !== null && $user->access >= $level){
                  return $next($request);
              }
          }
        }

        return redirect()->route('welcome');
    }
}

if (!function_exists('getallheaders')) 
{ 
    function getallheaders() 
    { 
           $headers = []; 
       foreach ($_SERVER as $name => $value) 
       { 
           if (substr($name, 0, 5) == 'HTTP_') 
           { 
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
           } 
       } 
       return $headers; 
    } 
} 