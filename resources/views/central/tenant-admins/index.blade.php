@extends('central.layouts.app')

@section('title', 'Administradores de Tenants')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Administradores de Tenants</h1>
        <a href="{{ route('central.tenant-admins.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Crear Administrador
        </a>
    </div>

    <div class="mb-4">
        <form method="GET" action="{{ route('central.tenant-admins.index') }}" class="flex gap-2">
            <select name="tenant" onchange="this.form.submit()" class="px-3 py-2 border border-gray-300 rounded-md">
                <option value="">Todos los Tenants</option>
                @foreach($tenants as $tenant)
                    <option value="{{ $tenant->id }}" {{ $selectedTenant == $tenant->id ? 'selected' : '' }}>
                        {{ $tenant->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">Nombre</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Tenant</th>
                    <th class="px-6 py-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $admin->name }}</td>
                        <td class="px-6 py-4">{{ $admin->email }}</td>
                        <td class="px-6 py-4">{{ $admin->tenant->name }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('central.tenant-admins.edit', $admin) }}"
                                    class="text-blue-600 hover:text-blue-800">Editar</a>
                                <form method="POST" action="{{ route('central.tenant-admins.destroy', $admin) }}" class="inline"
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
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay administradores de tenant</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $admins->links() }}
    </div>
@endsection