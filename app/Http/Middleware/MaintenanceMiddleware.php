<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isMaintenanceMode = \App\Models\Setting::getValue('is_maintenance_mode') === 'true';

        if ($isMaintenanceMode) {
            // Allow admin and superadmin
            if (auth()->check() && auth()->user()->isAdmin()) {
                return $next($request);
            }

            // Allowed routes during maintenance
            $allowedRoutes = ['login', 'admin.login', 'admin.login.store'];
            if ($request->route() && in_array($request->route()->getName(), $allowedRoutes)) {
                return $next($request);
            }
            
            // Allow paths explicitly
            if ($request->is('login') || $request->is('admin/login')) {
                return $next($request);
            }

            // Allowed paths (like assets)
            if ($request->is('assets/*') || $request->is('build/*')) {
                return $next($request);
            }

            return response()->view('errors.maintenance', [], 503);
        }

        return $next($request);
    }
}
