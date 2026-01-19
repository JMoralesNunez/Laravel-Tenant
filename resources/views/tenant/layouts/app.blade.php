<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - ' . tenant()->name)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <nav class="bg-purple-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div>
                    <a href="{{ route('tenant.dashboard') }}" class="text-xl font-bold">{{ tenant()->name }} - Admin</a>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('tenant.dashboard') }}" class="hover:text-purple-200">Dashboard</a>
                    <a href="{{ route('tenant.products.index') }}" class="hover:text-purple-200">Productos</a>
                    <a href="{{ route('tenant.home') }}" target="_blank" class="hover:text-purple-200">Ver Tienda</a>
                    <form method="POST" action="{{ route('tenant.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-purple-200">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>

</html>