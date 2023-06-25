<?php

namespace App\Http\Middleware;

use Closure;

class APIToken
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
        {
            if($request->header('Authorization')){
                return $next($request)
                    ->header("Access-Control-Allow-Origin", "http://urlfronted.example")
                    //Métodos que a los que se da acceso
                    ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE")
                    //Headers de la petición
                    ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization"); 
                }
                return response()->json([
                 'message' => 'Not a valid API request.',
            ]);
        }
    }
}
