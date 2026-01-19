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

        // Attempt login using the 'tenant' guard
        // The TenantAdmin model is configured to use the 'central' connection
        if (
            Auth::guard('tenant')->attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password'],
                'tenant_id' => tenant('id') // Ensure the admin belongs to this tenant
            ], $request->boolean('remember'))
        ) {
            $request->session()->regenerate();

            return redirect()->intended(route('tenant.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros o no tienes acceso a esta tienda.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::guard('tenant')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('tenant.login');
    }
}
