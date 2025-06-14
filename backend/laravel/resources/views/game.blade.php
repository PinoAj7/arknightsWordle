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

    <script src="{{ asset('js/game.js') }}"></script>

</body>
</html>