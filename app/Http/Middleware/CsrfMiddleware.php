<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CsrfMiddleware{

  public function handle($request, Closure $next){
      if ($request->header('csrf-token') !== auth()->payload()->get('csrf-token')) {
          throw new AuthorizationException;
      }
      return $next($request);
  }

}
