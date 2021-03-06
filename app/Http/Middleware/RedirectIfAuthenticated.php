<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'backend')
    { 
        if (Auth::guard($guard)->check()) {
            return redirect('/backend');
        }
        
        if (Auth::guard('web')->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
