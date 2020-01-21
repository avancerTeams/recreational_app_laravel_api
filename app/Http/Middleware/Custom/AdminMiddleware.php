<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Auth;

class AdminMiddleware
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
        // Check if logged in user is an Admin.
        // Login by API or normal HTTP is checked.
        if (
            (Auth::check() && Auth::user()->isAdmin())
            ||
            (Auth::guard('api')->check() && Auth::guard('api')->user()->isAdmin())
        ) {
            return $next($request);
        } else {
            // if ($request->expectsJson() || $request->isJson()) {
            return response()->json([
                'error' => 'Unauthorized access!',
                'description' => 'Admin access only',
                'code' => 403,
            ], 403);
        }
    }
}
