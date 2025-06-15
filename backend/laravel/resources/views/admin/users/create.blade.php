@extends('layouts.admin')

@section('content')
<div class="container mx-auto max-w-3xl p-6 bg-white bg-opacity-90 rounded shadow mt-6">
    <h2 class="text-2xl font-bold mb-6">Crear Nuevo Usuario</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="username" class="block font-semibold mb-1">Nombre de usuario</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required
                class="w-full p-2 border rounded @error('username') border-red-500 @enderror">
            @error('username')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                class="w-full p-2 border rounded @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block font-semibold mb-1">Contraseña</label>
            <input type="password" id="password" name="password" required
                class="w-full p-2 border rounded @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block font-semibold mb-1">Confirmar contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                class="w-full p-2 border rounded">
        </div>

        <div class="flex items-center space-x-4">
            <input type="checkbox" id="is_admin" name="is_admin" {{ old('is_admin') ? 'checked' : '' }}>
            <label for="is_admin" class="font-semibold">¿Es administrador?</label>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Crear</button>
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 transition">Cancelar</a>
        </div>
    </form>
</div>
@endsection