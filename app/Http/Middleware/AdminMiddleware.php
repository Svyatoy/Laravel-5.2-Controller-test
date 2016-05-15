<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class AdminMiddleware
{
    /**
     * Handle an incoming request for admin check.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
            if ($user->role !== 'admin') {
                return response('Admin only', 403);
            }else{
                return $next($request);
            }
        }else{
            return response('Admin only.', 403);
        }
    }
}
