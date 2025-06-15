<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-900 text-white relative overflow-hidden">
        {{-- Fondo opcional con imagen --}}
        <div class="absolute inset-0 bg-cover bg-center opacity-20 z-0" style="background-image: url('{{ asset('images/fondo-arknights.jpg') }}');"></div>
        <div class="absolute inset-0 bg-black bg-opacity-70 z-0"></div>

        {{-- Contenido --}}
        <div class="z-10 w-full max-w-md bg-gray-800 bg-opacity-90 p-8 rounded shadow-lg">
            <h1 class="text-2xl font-bold mb-6 text-center text-white">Iniciar sesión en Arknights Wordle</h1>

            <form method="POST" action="/auth/login">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-white">Correo electrónico</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="mt-1 w-full p-2 rounded bg-gray-800 text-white placeholder-gray-400 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="correo@ejemplo.com"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-white">Contraseña</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="mt-1 w-full p-2 rounded bg-gray-800 text-white placeholder-gray-400 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="********"
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-4 flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="remember_me" class="ml-2 block text-sm text-white">Recuérdame</label>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('register') }}" class="text-sm text-blue-400 hover:underline">¿No tienes cuenta?</a>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>