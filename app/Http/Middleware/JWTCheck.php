<?php

namespace App\Http\Middleware;

use Cookie;
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
        $token = Cookie::get('token');
        
        if( is_null($token) ) {
            if (! $token = $this->auth->setRequest($request)->getToken()) {
                return redirect('login');
            }
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
                return redirect('login');
        } catch (JWTException $e) {
                 return redirect('login');
        }

        if (! $user) {
                 return redirect('login');
        }
        
        $this->events->fire('tymon.jwt.valid', $user);
        return $next($request);
    }
}
