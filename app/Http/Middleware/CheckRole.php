<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
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
        return abort(403,'You are not an '.$role);
    }
}
