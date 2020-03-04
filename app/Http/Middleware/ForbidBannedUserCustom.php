<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class ForbidBannedUserCustom
{
    protected $auth;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();
        if ($user && $user->isBanned()) {
            return redirect('/')->with(
                'message', 'This account is blocked for Reporting');
        }
        return $next($request);
    }
}
