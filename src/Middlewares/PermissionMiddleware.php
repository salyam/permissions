<?php

namespace Salyam\Permissions\Middlewares;

use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if($request->user() == null || !$request->user()->HasPermission($permission)) {
            abort(403);
        }
        return $next($request);
    }
}