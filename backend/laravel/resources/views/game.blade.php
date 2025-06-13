<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Arknights Wordle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-300 text-gray-800">

    <div class="container mx-auto p-4 max-w-xl">
        <h1 class="text-3xl font-bold mb-4">Adivina el Personaje de Arknights</h1>

        <div class="absolute top-4 right-4 z-10">
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Logout</button>
            </form>
            @else
                <button id="login-button" class="px-4 py-2 bg-blue-500 text-white rounded mr-2">Login</button>
                <button id="register-button" class="px-4 py-2 bg-green-500 text-white rounded">Registro</button>
            @endauth
        </div>

        <!-- Contenedor principal -->
        <div id="game-container">
            <input id="guess-input" type="text" placeholder="Escribe el nombre..." class="w-full p-2 border rounded mb-2" autocomplete="off" />
            <ul id="suggestions" class="bg-white border rounded hidden max-h-40 overflow-auto"></ul>
            <div id="attempts" class="space-y-2 mt-4 bg-gray-800 p-4 rounded text-white"></div>
        </div>

        <!-- Modal de login/registro -->
        <div id="login-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
            <div class="bg-white p-8 rounded shadow-md w-96 relative">
                <button id="close-modal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
        
                <!-- Login form -->
                <div id="login-form">
                    <h2 class="text-xl font-bold mb-4">Iniciar Sesión</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <input type="password" name="password" id="password" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Entrar</button>
                    </form>
                <p class="mt-4 text-sm">¿No tienes cuenta? <a href="#" id="show-register" class="text-blue-500 hover:underline">Regístrate</a></p>
            </div>

            <!-- Register form -->
            <div id="register-form" class="hidden">
                <h2 class="text-xl font-bold mb-4">Registrarse</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                        <input type="text" name="username" id="username" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="register-email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" name="password" id="register-password" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Registrarse</button>
                </form>
            <p class="mt-4 text-sm">¿Ya tienes cuenta? <a href="#" id="show-login" class="text-blue-500 hover:underline">Inicia sesión</a></p>
        </div>
    </div>

    <script src="{{ asset('js/game.js') }}"></script>

</body>
</html>