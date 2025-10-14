<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Adjust this check for your user model!
        // If you use a method like hasRole(), update accordingly.
        if (!$request->user() || $request->user()->role !== $role) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}