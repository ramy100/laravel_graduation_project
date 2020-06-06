<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        if ( $request->user()) {
            if ($request->user()->role == $role){
                return $next($request);
            }
        }
        return redirect('/403')->with('error','You are not authorised to access admin pages.');
    }
}
