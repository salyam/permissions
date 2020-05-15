<?php

namespace Salyam\Permissions\Middlewares;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if($request->user() == null || !$request->user()->HasRole($role))
        {
            abort(403);
        }

        return $next($request);
    }
}