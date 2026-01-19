<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class TenantAuth
{
    /**
     * Handle an incoming request for tenant admin authentication.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('tenant')->check()) {
            return redirect()->route('tenant.login');
        }

        // Verify the authenticated admin belongs to the current tenant
        $admin = Auth::guard('tenant')->user();

        if ($admin->tenant_id !== tenant('id')) {
            Auth::guard('tenant')->logout();
            return redirect()->route('tenant.login')->withErrors([
                'email' => 'No tienes permiso para acceder a esta tienda.'
            ]);
        }

        // Share admin with views
        view()->share('tenantAdmin', $admin);

        return $next($request);
    }
}
