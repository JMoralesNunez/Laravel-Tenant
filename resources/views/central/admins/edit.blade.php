@extends('central.layouts.app')

@section('title', 'Editar Administrador Central')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Editar Administrador Central</h1>

        <div class="bg-white rounded-lg shadow p-6">
            <form method="POST" action="{{ route('central.admins.update', $admin) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre Completo</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 bg-yellow-50 p-3 rounded-md border border-yellow-200">
                    <p class="text-yellow-700 text-sm italic">Deja en blanco para mantener la contraseña actual.</p>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Nueva Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirmar Nueva
                        Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('central.admins.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Cancelar
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Actualizar Administrador
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection