<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (mixed)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()?->role !== 'admin') {
            abort(403);
        }

        return $next($request);
    }
}
