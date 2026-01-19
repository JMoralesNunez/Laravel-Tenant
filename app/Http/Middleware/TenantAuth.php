<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\TenantAdmin;

class TenantAuth
{
    /**
     * Handle an incoming request for tenant admin authentication.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $adminId = $request->session()->get('tenant_admin_id');

        if (!$adminId) {
            return redirect()->route('tenant.login');
        }

        // Verify admin exists and belongs to current tenant
        $admin = TenantAdmin::where('id', $adminId)
            ->where('tenant_id', tenant('id'))
            ->first();

        if (!$admin) {
            $request->session()->forget('tenant_admin_id');
            return redirect()->route('tenant.login');
        }

        // Share admin with views
        view()->share('tenantAdmin', $admin);

        return $next($request);
    }
}
