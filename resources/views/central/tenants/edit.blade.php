@extends('central.layouts.app')

@section('title', 'Editar Tenant')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Editar Tenant</h1>

        <div class="bg-white rounded-lg shadow p-6">
            <form method="POST" action="{{ route('central.tenants.update', $tenant) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre del Negocio</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $tenant->name) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="domain" class="block text-gray-700 font-bold mb-2">Dominio</label>
                    <input type="text" name="domain" id="domain"
                        value="{{ old('domain', $tenant->domains->first()?->domain) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="business_type" class="block text-gray-700 font-bold mb-2">Tipo de Negocio</label>
                    <input type="text" name="business_type" id="business_type"
                        value="{{ old('business_type', $tenant->business_type) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-bold mb-2">Estado</label>
                    <select name="status" id="status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="active" {{ $tenant->status === 'active' ? 'selected' : '' }}>Activo</option>
                        <option value="inactive" {{ $tenant->status === 'inactive' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('central.tenants.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Cancelar
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Actualizar Tenant
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection