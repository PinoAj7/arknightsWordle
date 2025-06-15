@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4 text-white">Crear nuevo personaje</h2>

    <form action="{{ route('admin.characters.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Nombre</label>
            <input type="text" name="name" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Ruta de imagen</label>
            <input type="text" name="image" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Imagen de facción</label>
            <input type="text" name="faction" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Imagen de clase</label>
            <input type="text" name="class" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Imagen de arquetipo</label>
            <input type="text" name="archetype" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Rareza (1-6)</label>
            <input type="number" name="rarity" min="1" max="6" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Costo de DP</label>
            <input type="number" name="dp_cost" min="1" class="w-full p-2 border rounded" required>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Guardar</button>
        </div>
    </form>
@endsection
