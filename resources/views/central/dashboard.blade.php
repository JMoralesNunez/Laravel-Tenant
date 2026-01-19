@extends('central.layouts.app')

@section('title', 'Dashboard - Central Admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Central</h1>
        <p class="text-gray-600">Bienvenido al panel de administración de MultiStore</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Tenants</div>
            <div class="text-3xl font-bold text-blue-600">{{ $stats['total_tenants'] }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="text-sm text-gray-500">Tenants Activos</div>
            <div class="text-3xl font-bold text-green-600">{{ $stats['active_tenants'] }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="text-sm text-gray-500">Admins de Tenant</div>
            <div class="text-3xl font-bold text-purple-600">{{ $stats['total_tenant_admins'] }}</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Tenants Recientes</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Dominio</th>
                        <th class="px-4 py-2 text-left">Tipo de Negocio</th>
                        <th class="px-4 py-2 text-left">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_tenants as $tenant)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $tenant->name }}</td>
                            <td class="px-4 py-2">{{ $tenant->domains->first()?->domain ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $tenant->business_type }}</td>
                            <td class="px-4 py-2">
                                <span
                                    class="px-2 py-1 rounded text-xs {{ $tenant->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $tenant->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">No hay tenants</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection