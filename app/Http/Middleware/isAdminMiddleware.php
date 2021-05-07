<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class isAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if($user){
          if($user->type == 'Manager'){
            return $next($request);
          }
        }
        return response()->json(['status' => false, 'message' => 'You must be a manager to access this endpoint'], 401);
    }
}
