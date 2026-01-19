<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MultiStore Global</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-700 to-blue-900 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border-t-8 border-indigo-600">
        <div class="text-center mb-8">
            <span
                class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold tracking-widest uppercase mb-4">
                System Central Admin
            </span>
            <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">MultiStore</h2>
            <p class="text-gray-500 mt-2 font-medium">Plataforma de Control Global</p>
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

        <form method="POST" action="{{ route('central.login') }}" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email de Super Admin</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    placeholder="admin@multistore.test"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Contraseña</label>
                <input type="password" name="password" id="password" required placeholder="••••••••"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember"
                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="remember" class="ml-2 text-sm text-gray-600 font-medium">Mantener sesión iniciada</label>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold hover:bg-indigo-700 transform hover:-translate-y-1 transition-all shadow-lg active:scale-95">
                Ingresar al Sistema
            </button>
        </form>

        <div class="mt-8 pt-4 text-center">
            <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold">
                Acceso restringido a personal autorizado
            </p>
        </div>
    </div>
</body>

</html>