<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ tenant()->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-purple-500 to-purple-700 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-md">
        <h2 class="text-3xl font-bold text-center mb-2 text-gray-800">{{ tenant()->name }}</h2>
        <p class="text-center text-gray-600 mb-6">Panel de Administración</p>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tenant.login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Contraseña</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <button type="submit"
                class="w-full bg-purple-600 text-white py-2 rounded-md hover:bg-purple-700 transition duration-200">
                Iniciar Sesión
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('tenant.home') }}" class="text-sm text-purple-600 hover:text-purple-800">← Volver a la
                tienda</a>
        </div>

        <p class="mt-4 text-center text-sm text-gray-600">
            Password por defecto: password
        </p>
    </div>
</body>

</html>