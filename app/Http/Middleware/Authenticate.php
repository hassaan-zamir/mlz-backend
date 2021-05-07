<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use \Illuminate\Auth\AuthenticationException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request,Closure $next,...$guards){

      if($jwt = $request->cookie('jwt')){
        $request->headers->set('Authorization','Bearer '.$jwt);
      }
      try{
        $this->authenticate($request,$guards);
        return $next($request);
      }catch(AuthenticationException $ex){
        return response()->json(['status' => false, 'message' => 'Unauthorized'],401);
      }


    }
}
