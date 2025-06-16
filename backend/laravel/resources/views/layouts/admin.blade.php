<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Panel Admin - Arknights Wordle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="relative min-h-screen flex flex-col text-gray-800">

    <!-- Fondo -->
    <div class="absolute inset-0 bg-[url('/images/fondo-arknights.jpg')] bg-cover bg-center z-0"></div>
    <div class="absolute inset-0 bg-black bg-opacity-40 z-0"></div>

    <!-- Contenido -->
    <div class="relative z-10 flex flex-col flex-grow">

        <!-- Header -->
        <header class="bg-gray-300 bg-opacity-90 shadow p-4 sm:p-4 md:p-4 flex flex-col sm:flex-row items-center justify-between">
            <h1 class="text-2xl sm:text-2xl md:text-2xl font-bold text-gray-900 mb-2 sm:mb-0">Panel de Administración</h1>
    
            <p class="text-gray-700 sm:text-gray-700 md:text-gray-700 mb-2 sm:mb-0">Bienvenido, <strong>{{ Auth::user()->username }}</strong></p>

            <div class="flex flex-col sm:flex-row gap-2 sm:space-x-2 sm:gap-0">
                <a href="{{ route('game') }}" class="px-4 py-2 sm:px-4 sm:py-2 md:px-4 md:py-2 text-base sm:text-base md:text-base bg-indigo-500 text-white rounded hover:bg-indigo-600 transition">
                    Volver al Juego
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 sm:px-4 sm:py-2 md:px-4 md:py-2 text-base sm:text-base md:text-base bg-red-500 text-white rounded hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Main -->
        <main class="container mx-auto max-w-6xl p-4 sm:p-4 md:p-4 flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 bg-opacity-80 text-gray-300 text-center text-sm sm:text-sm md:text-sm py-4 sm:py-4 md:py-4">
            <p>&copy; {{ date('Y') }} - Arknights Wordle (Proyecto sin fines comerciales)</p>
            <p class="mt-1">Todos los derechos de imágenes y contenido pertenecen a <strong>Yostar</strong> y <strong>Hypergryph</strong>.</p>
            <p class="mt-1">Este proyecto es fanmade y no está afiliado oficialmente.</p>
        </footer>

    </div>
</body>
</html>