@extends('layouts.admin')

@section('content')
<div class="container mx-auto max-w-3xl p-4 bg-white bg-opacity-90 rounded shadow mt-6">
    <h2 class="text-2xl font-bold mb-4">Editar Usuario: {{ $user->username }}</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="username" class="block font-semibold mb-1">Usuario</label>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required
                class="w-full p-2 border rounded" />
        </div>

        <div>
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                class="w-full p-2 border rounded" />
        </div>

        <div>
            <label for="password" class="block font-semibold mb-1">Contraseña <small class="text-gray-500">(dejar vacío para no cambiar)</small></label>
            <input type="password" name="password" id="password" class="w-full p-2 border rounded" autocomplete="new-password" />
        </div>

        <div class="flex items-center space-x-4">
            <input type="checkbox" id="is_admin" name="is_admin" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
            <label for="is_admin" class="font-semibold">¿Es administrador?</label>
        </div>

        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Guardar Cambios
            </button>
            <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
        </div>
    </form>
</div>
@endsection
