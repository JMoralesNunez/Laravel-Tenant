@extends('tenant.layouts.app')

@section('title', 'Crear Producto')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Crear Nuevo Producto</h1>

        <div class="bg-white rounded-lg shadow p-6">
            <form method="POST" action="{{ route('tenant.products.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Descripción</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Precio</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Imagen</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('tenant.products.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Cancelar
                    </a>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                        Crear Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection