<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
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
        if(auth()->user()->isBanned()){
            $message = 'Your account has been suspended. Please contact administrator.';
            return response()->json($message);
        }
        else{
            return $next($request);
        }
    }
}
