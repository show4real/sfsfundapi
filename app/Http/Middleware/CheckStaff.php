<?php

namespace App\Http\Middleware;

use Closure;

class CheckStaff
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
        // if approver is true, don't give access
        if (auth()->user()->approver == 1) {
            return response()->json(['error' => 'You don\'t have sufficient permission to access this resource'], 403);
          }
    
          return $next($request);
    }
}
