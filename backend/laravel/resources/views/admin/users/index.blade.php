@extends('layouts.admin')

@section('content')
<div class="bg-white bg-opacity-90 rounded shadow p-6">
    <h2 class="text-xl font-bold mb-4 text-gray-900">Gestión de Usuarios</h2>

    <a href="{{ route('admin.users.create') }}" class="inline-block mb-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Crear nuevo usuario</a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 text-sm">
            <thead class="bg-gray-100 text-gray-800">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Username</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Rol</th>
                    <th class="p-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="text-gray-700">
                        <td class="p-2 border">{{ $user->id }}</td>
                        <td class="p-2 border">{{ $user->username }}</td>
                        <td class="p-2 border">{{ $user->email }}</td>
                        <td class="p-2 border">{{ $user->is_admin ? 'Admin' : 'Usuario' }}</td>
                        <td class="p-2 border space-x-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Editar</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection