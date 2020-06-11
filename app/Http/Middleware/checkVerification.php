<?php

namespace App\Http\Middleware;

use Closure;

class checkVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$status)
    {
        if ( $request->user()) {
            if ($request->user()->profile->is_verified === $status){
                return $next($request);
            }
        }
        return abort(403,'Unauthorized Access');
    }
}
