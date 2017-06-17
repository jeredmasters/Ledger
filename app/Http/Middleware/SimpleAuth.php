<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
class SimpleAuth
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
        $user = $request->session()->get('user', null);

        if ($user !== null){
            $user = User::find($user->id);
            if($user->access >= $level){
                return $next($request);
            }
        }
        return $next($request);
        return redirect()->route('welcome');
    }
}
