<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\TenantAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TenantAdminController extends Controller
{
    /**
     * Display a listing of tenant admins
     */
    public function index(Request $request)
    {
        $tenants = Tenant::with('admins')->get();
        $selectedTenant = $request->query('tenant');

        $admins = TenantAdmin::with('tenant')
            ->when($selectedTenant, function ($query, $selectedTenant) {
                return $query->where('tenant_id', $selectedTenant);
            })
            ->latest()
            ->paginate(10);

        return view('central.tenant-admins.index', compact('admins', 'tenants', 'selectedTenant'));
    }

    /**
     * Show the form for creating a new tenant admin
     */
    public function create()
    {
        $tenants = Tenant::where('status', 'active')->get();
        return view('central.tenant-admins.create', compact('tenants'));
    }

    /**
     * Store a newly created tenant admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check for unique email per tenant
        $exists = TenantAdmin::where('tenant_id', $validated['tenant_id'])
            ->where('email', $validated['email'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['email' => 'Este email ya está registrado para este tenant.'])->withInput();
        }

        TenantAdmin::create([
            'tenant_id' => $validated['tenant_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('central.tenant-admins.index')
            ->with('success', 'Administrador de tenant creado exitosamente.');
    }

    /**
     * Show the form for editing the specified tenant admin
     */
    public function edit(TenantAdmin $tenantAdmin)
    {
        $tenants = Tenant::where('status', 'active')->get();
        return view('central.tenant-admins.edit', compact('tenantAdmin', 'tenants'));
    }

    /**
     * Update the specified tenant admin
     */
    public function update(Request $request, TenantAdmin $tenantAdmin)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Check for unique email per tenant (excluding current record)
        $exists = TenantAdmin::where('tenant_id', $validated['tenant_id'])
            ->where('email', $validated['email'])
            ->where('id', '!=', $tenantAdmin->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['email' => 'Este email ya está registrado para este tenant.'])->withInput();
        }

        $tenantAdmin->update([
            'tenant_id' => $validated['tenant_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->filled('password')) {
            $tenantAdmin->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('central.tenant-admins.index')
            ->with('success', 'Administrador de tenant actualizado exitosamente.');
    }

    /**
     * Remove the specified tenant admin
     */
    public function destroy(TenantAdmin $tenantAdmin)
    {
        $tenantAdmin->delete();

        return redirect()->route('central.tenant-admins.index')
            ->with('success', 'Administrador de tenant eliminado exitosamente.');
    }
}
