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
                    ->header("Access-Control-Allow-Origin", "http://68.183.50.234:12345")
                    ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE")
                    ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization"); 
                }
                return response()->json([
                 'message' => 'Not a valid API request.',
            ]);
        }
    }
}
