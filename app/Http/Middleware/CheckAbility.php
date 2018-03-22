<?php

namespace App\Http\Middleware;

use Closure;

class CheckAbility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $ability)
    {
        if (! $request->user()->can($ability)) {
          return response('Yeah no', 401);
        }
        return $next($request);
    }
}
