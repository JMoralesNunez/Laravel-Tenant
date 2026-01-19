@extends('central.layouts.app')

@section('title', 'Tenants')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Tenants</h1>
        <a href="{{ route('central.tenants.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Crear Tenant
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dominio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tenants as $tenant)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $tenant->name }}</td>
                        <td class="px-6 py-4">{{ $tenant->domains->first()?->domain ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $tenant->business_type }}</td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('central.tenants.toggle-status', $tenant) }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-2 py-1 rounded text-xs {{ $tenant->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $tenant->status }}
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('central.tenants.edit', $tenant) }}"
                                    class="text-blue-600 hover:text-blue-800">Editar</a>
                                <form method="POST" action="{{ route('central.tenants.destroy', $tenant) }}" class="inline"
                                    onsubmit="return confirm('¿Estás seguro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay tenants creados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tenants->links() }}
    </div>
@endsection