<?php

namespace App\Backend\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Backend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'backend')
    {
        if (Auth::guard($guard)->check())
        {
            return $next($request);
        }
        return redirect('backend/login');
    }
}
