<?php

namespace BajomoDavid\JWTAuth\Middleware;

use BajomoDavid\JWTAuth\Validators\Authenticate;
use Closure;

class CheckToken
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
        $token = $request->header('Authorization');

        if(!Authenticate::check($token)) return response()->json('Unauthorized', 401);

        return $next($request);
    }
}
