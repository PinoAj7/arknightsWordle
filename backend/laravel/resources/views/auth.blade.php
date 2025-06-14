<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login / Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-300 text-gray-800 flex items-center justify-center min-h-screen">

    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <div id="login-form">
            <h2 class="text-xl font-bold mb-4">Iniciar Sesión</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label class="block mb-2">Email</label>
                <input name="email" type="email" required class="w-full mb-4 p-2 border rounded">
                
                <label class="block mb-2">Contraseña</label>
                <input name="password" type="password" required class="w-full mb-4 p-2 border rounded">

                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Entrar</button>
            </form>

            <p class="mt-4 text-sm text-center">
                ¿No tienes cuenta? 
                <a href="#" id="show-register" class="text-blue-500 hover:underline">Regístrate</a>
            </p>
        </div>

        <div id="register-form" class="hidden">
            <h2 class="text-xl font-bold mb-4">Registro</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label class="block mb-2">Nombre de Usuario</label>
                <input name="username" required class="w-full mb-4 p-2 border rounded">

                <label class="block mb-2">Email</label>
                <input name="email" type="email" required class="w-full mb-4 p-2 border rounded">

                <label class="block mb-2">Contraseña</label>
                <input name="password" type="password" required class="w-full mb-4 p-2 border rounded">

                <label class="block mb-2">Confirmar Contraseña</label>
                <input name="password_confirmation" type="password" required class="w-full mb-4 p-2 border rounded">

                <button type="submit" class="w-full bg-green-500 text-white p-2 rounded">Registrarse</button>
            </form>

            <p class="mt-4 text-sm text-center">
                ¿Ya tienes cuenta? 
                <a href="#" id="show-login" class="text-blue-500 hover:underline">Inicia sesión</a>
            </p>
        </div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
