<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ tenant()->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-emerald-500 to-teal-700 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border-t-8 border-emerald-600">
        <div class="text-center mb-8">
            <span
                class="inline-block px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold tracking-widest uppercase mb-4">
                Store Admin Panel
            </span>
            <h2 class="text-3xl font-extrabold text-gray-900">{{ tenant()->name }}</h2>
            <p class="text-gray-500 mt-2 italic capitalize">{{ tenant()->business_type }}</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tenant.login') }}" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email de Administrador</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    placeholder="ej: admin@{{ tenant()->id }}.test"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Contraseña</label>
                <input type="password" name="password" id="password" required placeholder="••••••••"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember"
                    class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                <label for="remember" class="ml-2 text-sm text-gray-600 font-medium">Recordar sesión</label>
            </div>

            <button type="submit"
                class="w-full bg-emerald-600 text-white py-3 rounded-xl font-bold hover:bg-emerald-700 transform hover:-translate-y-1 transition-all shadow-lg active:scale-95">
                Acceder al Panel
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <a href="{{ route('tenant.home') }}"
                class="text-sm font-medium text-emerald-600 hover:text-emerald-800 transition-colors inline-flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a la tienda pública
            </a>
        </div>
    </div>
</body>

</html>