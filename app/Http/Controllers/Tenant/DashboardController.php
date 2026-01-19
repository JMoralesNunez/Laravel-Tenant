<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Display the tenant admin dashboard
     */
    public function index()
    {
        $tenant = tenant();

        $stats = [
            'total_products' => Product::count(),
            'recent_products' => Product::latest()->take(5)->get(),
        ];

        return view('tenant.dashboard', compact('tenant', 'stats'));
    }
}
