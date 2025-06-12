<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Arknights Wordle</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300 text-gray-800">

    <div class="container mx-auto p-4 max-w-xl">
        <h1 class="text-3xl font-bold mb-4">Adivina el Personaje de Arknights</h1>

        <!-- Botón Login / Registro -->
        <div class="flex justify-end mb-4">
            <button id="auth-button" class="px-4 py-2 bg-blue-600 text-white rounded">Login / Registro</button>
        </div>


        <!-- Contenedor principal -->
        <div id="game-container">
            <input id="guess-input" type="text" placeholder="Escribe el nombre..." class="w-full p-2 border rounded mb-2" autocomplete="off" />
            <ul id="suggestions" class="bg-white border rounded hidden max-h-40 overflow-auto"></ul>
            <div id="attempts" class="space-y-2 mt-4 bg-gray-800 p-4 rounded text-white"></div>
        </div>

        <!-- Modal Login / Registro -->
        <div id="auth-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded p-6 w-full max-w-md relative">
                <button id="modal-close" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">&times;</button>

                <div id="auth-forms">
                    <button id="login-button" class="px-4 py-2 bg-blue-500 text-white rounded mr-2">Login</button>
                    <button id="register-button" class="px-4 py-2 bg-green-500 text-white rounded">Registro</button>

                    <button id="toggle-register" class="hidden"></button>
                    <button id="toggle-login" class="hidden"></button>

                    <div id="login-form" class="mt-4">
                        <input type="email" id="login-email" placeholder="Email" class="w-full mb-2 p-2 border rounded" />
                        <input type="password" id="login-password" placeholder="Contraseña" class="w-full mb-2 p-2 border rounded" />
                        <button id="login-submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Entrar</button>
                        <p id="login-error" class="text-red-600 mt-2 hidden"></p>
                    </div>

                    <div id="register-form" class="mt-4 hidden">
                        <input type="text" id="register-name" placeholder="Nombre" class="w-full mb-2 p-2 border rounded" />
                        <input type="email" id="register-email" placeholder="Email" class="w-full mb-2 p-2 border rounded" />
                        <input type="password" id="register-password" placeholder="Contraseña" class="w-full mb-2 p-2 border rounded" />
                        <input type="password" id="register-password-confirm" placeholder="Confirmar contraseña" class="w-full mb-2 p-2 border rounded" />
                        <button id="register-submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Registrarse</button>
                        <p id="register-error" class="text-red-600 mt-2 hidden"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/game.js') }}"></script>

</body>
</html>