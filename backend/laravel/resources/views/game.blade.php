<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Arknights Wordle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="relative min-h-screen flex flex-col text-gray-800">

    <!-- Fondo -->
    <div class="absolute inset-0 bg-[url('/images/fondo-arknights.jpg')] bg-cover bg-center z-0"></div>
    <div class="absolute inset-0 bg-black bg-opacity-40 z-0"></div>

    <!-- Contenido -->
    <div class="relative z-10 flex flex-col flex-grow">

        <!-- Header -->
        <header class="bg-gray-300 bg-opacity-90 shadow p-4 flex flex-col sm:flex-row items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 mb-2 sm:mb-0">Adivina el Personaje de Arknights</h1>
            @auth
                <p class="text-gray-700 mb-2 sm:mb-0">Bienvenido, <strong>{{ Auth::user()->username }}</strong></p>
            @endauth
            <div class="space-x-2">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">Logout</button>
                    </form>
                @else
                    <button onclick="window.location.href='/auth'" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Login</button>
                    <button onclick="window.location.href='/auth/register'" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">Registro</button>
                @endauth
            </div>
        </header>

        <!-- Main -->
        <main class="container mx-auto max-w-xl p-4 flex-grow">
            <div id="game-container" class="bg-white p-4 rounded shadow">
                <input id="guess-input" type="text" placeholder="Escribe el nombre..." class="w-full p-2 border rounded mb-2" autocomplete="off" />
                <ul id="suggestions" class="bg-white border rounded hidden max-h-40 overflow-auto"></ul>
                <div id="attempts" class="space-y-2 mt-4 bg-gray-800 p-4 rounded text-white"></div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 bg-opacity-80 text-gray-300 text-center text-sm py-4">
            <p>&copy; {{ date('Y') }} - Arknights Wordle (Proyecto sin fines comerciales)</p>
            <p>Todos los derechos de imágenes y contenido pertenecen a <strong>Yostar</strong> y <strong>Hypergryph</strong>.</p>
            <p>Este proyecto es fanmade y no está afiliado oficialmente.</p>
        </footer>

    </div>

    <script src="{{ asset('js/game.js') }}"></script>

</body>
</html>