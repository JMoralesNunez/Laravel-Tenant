<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $tenant->name ?? 'Tienda')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $tenant->name ?? 'Mi Tienda' }}</h1>
                    <p class="text-sm text-gray-500">{{ $tenant->business_type ?? '' }}</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('tenant.home') }}" class="text-gray-700 hover:text-blue-600">Inicio</a>
                    <a href="{{ route('tenant.login') }}" class="text-gray-700 hover:text-blue-600">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        @yield('content')
    </div>

    <footer class="bg-gray-800 text-white mt-12 py-6">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2026 {{ $tenant->name ?? 'Mi Tienda' }}. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>