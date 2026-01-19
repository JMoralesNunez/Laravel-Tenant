<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\CentralAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CentralAdminController extends Controller
{
    /**
     * Display a listing of central admins
     */
    public function index()
    {
        $admins = CentralAdmin::latest()->paginate(10);
        return view('central.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new admin
     */
    public function create()
    {
        return view('central.admins.create');
    }

    /**
     * Store a newly created admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:central_admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        CentralAdmin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('central.admins.index')
            ->with('success', 'Administrador central creado exitosamente.');
    }

    /**
     * Show the form for editing the specified admin
     */
    public function edit(CentralAdmin $admin)
    {
        return view('central.admins.edit', compact('admin'));
    }

    /**
     * Update the specified admin
     */
    public function update(Request $request, CentralAdmin $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:central_admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->filled('password')) {
            $admin->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('central.admins.index')
            ->with('success', 'Administrador actualizado exitosamente.');
    }

    /**
     * Remove the specified admin
     */
    public function destroy(CentralAdmin $admin)
    {
        $admin->delete();

        return redirect()->route('central.admins.index')
            ->with('success', 'Administrador eliminado exitosamente.');
    }
}
