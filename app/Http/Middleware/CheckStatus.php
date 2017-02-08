<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
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
        $response = $next($request);
        //If the status is not approved redirect to login 
        if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->status != 1){
            Auth::guard('admin')->logout();
            return redirect('admin/login')->with('warning', 'Account suppend!');
        }
        return $response;
    }
}
