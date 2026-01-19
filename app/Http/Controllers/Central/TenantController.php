<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    /**
     * Display a listing of tenants
     */
    public function index()
    {
        $tenants = Tenant::with('domains')->latest()->paginate(10);
        return view('central.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new tenant
     */
    public function create()
    {
        return view('central.tenants.create');
    }

    /**
     * Store a newly created tenant
     */
    public function store(Request $request)
    {
        $domain = $request->domain;
        if (!Str::endsWith($domain, '.multistore.test')) {
            $domain = $domain . '.multistore.test';
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:domains,domain',
            'business_type' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        // Create tenant
        $tenant = Tenant::create([
            'id' => Str::uuid(),
            'name' => $validated['name'],
            'business_type' => $validated['business_type'],
            'status' => $validated['status'],
        ]);

        // Create domain for tenant
        $tenant->domains()->create([
            'domain' => $domain,
        ]);

        return redirect()->route('central.tenants.index')
            ->with('success', 'Tenant creado exitosamente.');
    }

    /**
     * Show the form for editing the specified tenant
     */
    public function edit(Tenant $tenant)
    {
        $tenant->load('domains');
        return view('central.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified tenant
     */
    public function update(Request $request, Tenant $tenant)
    {
        $domain = $request->domain;
        if (!Str::endsWith($domain, '.multistore.test')) {
            $domain = $domain . '.multistore.test';
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:domains,domain,' . $tenant->domains->first()?->id,
            'business_type' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $tenant->update([
            'name' => $validated['name'],
            'business_type' => $validated['business_type'],
            'status' => $validated['status'],
        ]);

        // Update domain
        if ($tenant->domains->first()) {
            $tenant->domains->first()->update([
                'domain' => $domain,
            ]);
        }

        return redirect()->route('central.tenants.index')
            ->with('success', 'Tenant actualizado exitosamente.');
    }

    /**
     * Remove the specified tenant
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return redirect()->route('central.tenants.index')
            ->with('success', 'Tenant eliminado exitosamente.');
    }

    /**
     * Toggle tenant status
     */
    public function toggleStatus(Tenant $tenant)
    {
        $tenant->update([
            'status' => $tenant->status === 'active' ? 'inactive' : 'active',
        ]);

        return back()->with('success', 'Estado del tenant actualizado.');
    }
}
