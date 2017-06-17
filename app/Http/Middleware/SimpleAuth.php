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
        $user = User::find($user->id);
        if ($request->session()->get('user', null) === null || $user->access < $level){
            return redirect()->route('welcome');
        }
        return $next($request);
    }
}
