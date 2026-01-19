@extends('tenant.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard - {{ $tenant->name }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="text-sm text-gray-500">Total Productos</div>
            <div class="text-3xl font-bold text-purple-600">{{ $stats['total_products'] }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="text-sm text-gray-500">Tipo de Negocio</div>
            <div class="text-lg font-semibold text-gray-700">{{ $tenant->business_type }}</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Productos Recientes</h2>
        @if($stats['recent_products']->count() > 0)
            <div class="space-y-3">
                @foreach($stats['recent_products'] as $product)
                    <div class="flex justify-between items-center border-b pb-2">
                        <div>
                            <div class="font-semibold">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($product->description, 50) }}</div>
                        </div>
                        <div class="text-green-600 font-bold">${{ number_format($product->price, 2) }}</div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No hay productos creados aún.</p>
        @endif
    </div>
@endsection