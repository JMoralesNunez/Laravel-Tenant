<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\CentralAdmin;
use App\Models\TenantAdmin;

class DashboardController extends Controller
{
    /**
     * Display the central admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_tenants' => Tenant::count(),
            'active_tenants' => Tenant::where('status', 'active')->count(),
            'inactive_tenants' => Tenant::where('status', 'inactive')->count(),
            'total_admins' => CentralAdmin::count(),
            'total_tenant_admins' => TenantAdmin::count(),
        ];

        $recent_tenants = Tenant::latest()->take(5)->get();

        return view('central.dashboard', compact('stats', 'recent_tenants'));
    }
}
