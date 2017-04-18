<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        // allow all set to true, or allow domain list set to false
        $allowAll = false;
        // allow domain array list
        $domain = ['http://localhost:8080', 'http://192.168.1.100:8080', 'http://local.de'];
        if(isset($request->server()['HTTP_ORIGIN'])) {
            $origin = $request->server()['HTTP_ORIGIN'];
            if(in_array($origin, $domain) || $allowAll == true) {
                header('Access-Control-Allow-Origin: ' . $origin);
                header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
            }

        }
        return $next($request);
    }
}
