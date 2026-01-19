@extends('tenant.layouts.public')

@section('title', $tenant->name)

@section('content')
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">Bienvenido a {{ $tenant->name }}</h1>
        <p class="text-xl text-gray-600 mt-2">{{ $tenant->business_type }}</p>
    </div>

    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    @if($product->image_path)
                        <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">Sin imagen</span>
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-xl">No hay productos disponibles en este momento.</p>
        </div>
    @endif
@endsection