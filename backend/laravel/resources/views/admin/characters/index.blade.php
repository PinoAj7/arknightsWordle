@extends('layouts.admin')

@section('content')
    <div class="container mx-auto max-w-5xl p-4 bg-white bg-opacity-90 rounded shadow mt-6">
        <h2 class="text-2xl font-bold mb-4">Gestión de Personajes</h2>

        <div class="mb-4">
            <a href="{{ route('admin.characters.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Nuevo Personaje</a>
        </div>

        <div class="overflow-auto">
            <table class="min-w-full bg-gray-400 border rounded shadow text-sm text-gray-800">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Imagen</th>
                        <th class="p-2 border">Nombre</th>
                        <th class="p-2 border">Facción</th>
                        <th class="p-2 border">Clase</th>
                        <th class="p-2 border">Arquetipo</th>
                        <th class="p-2 border">Rareza</th>
                        <th class="p-2 border">Coste DP</th>
                        <th class="p-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($characters as $character)
                        <tr>
                            <td class="p-2 border text-center">{{ $character->id }}</td>
                            <td class="p-2 border text-center">
                                <img src="{{ asset($character->image) }}" alt="{{ $character->name }}" class="w-12 h-12 object-contain mx-auto">
                            </td>
                            <td class="p-2 border">{{ $character->name }}</td>
                            <td class="p-2 border text-center">
                                <img src="{{ asset($character->faction) }}" alt="Facción" class="w-8 h-8 object-contain mx-auto">
                            </td>
                            <td class="p-2 border text-center">
                                <img src="{{ asset($character->class) }}" alt="Clase" class="w-8 h-8 object-contain mx-auto">
                            </td>
                            <td class="p-2 border text-center">
                                <img src="{{ asset($character->archetype) }}" alt="Arquetipo" class="w-8 h-8 object-contain mx-auto">
                            </td>
                            <td class="p-2 border text-center">{{ $character->rarity }}</td>
                            <td class="p-2 border text-center">{{ $character->dp_cost }}</td>
                            <td class="p-2 border text-center space-x-2">
                                <a href="{{ route('admin.characters.edit', $character->id) }}" class="text-blue-600 hover:underline">Editar</a>
                                <form action="{{ route('admin.characters.destroy', $character->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar personaje?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($characters->isEmpty())
                        <tr>
                            <td colspan="9" class="p-4 text-center text-gray-500">No hay personajes registrados.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection