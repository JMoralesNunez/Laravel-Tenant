<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Product;

class LandingController extends Controller
{
    /**
     * Display the public landing page with product catalog
     */
    public function index()
    {
        $tenant = tenant();
        $products = Product::latest()->paginate(12);

        return view('tenant.landing', compact('tenant', 'products'));
    }
}
