<?php

namespace App\Http\Middleware;

use Closure;

class SimpleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->get('user', null) === null){
            return redirect()->route('welcome');
        }
        return $next($request);
    }
}
