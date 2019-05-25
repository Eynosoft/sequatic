<?php

namespace App\Backend\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\common\helpers\User;
use Closure;

class Admin
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
            if(User::getRoleName() === 'Admin'){
                return $next($request);
            }
        }
         abort(403,'You are not authorised to make this request.');
    }
}
