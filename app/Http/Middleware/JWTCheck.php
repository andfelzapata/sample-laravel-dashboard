<?php

namespace App\Http\Middleware;

use Lang;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

use Tymon\JWTAuth\Middleware\GetUserFromToken;

class JWTCheck extends GetUserFromToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (! $token = $this->auth->setRequest($request)->getToken()) {
            return response([],401);
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
                return response([],401);
        } catch (JWTException $e) {
                 return response([],401);
        }

        if (! $user) {
                return response([],401);
        }
        
        $this->events->fire('tymon.jwt.valid', $user);
        return $next($request);
    }
}
