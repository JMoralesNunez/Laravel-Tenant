<?php

namespace App\Http\Controllers\Tenant\Auth;

use App\Http\Controllers\Controller;
use App\Models\TenantAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('tenant.auth.login');
    }

    /**
     * Handle login request for tenant admin
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Get current tenant ID
        $tenantId = tenant('id');

        // Find tenant admin
        $admin = TenantAdmin::where('tenant_id', $tenantId)
            ->where('email', $credentials['email'])
            ->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // Manually login using session
            $request->session()->put('tenant_admin_id', $admin->id);
            $request->session()->regenerate();

            return redirect()->intended(route('tenant.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        $request->session()->forget('tenant_admin_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('tenant.login');
    }
}
