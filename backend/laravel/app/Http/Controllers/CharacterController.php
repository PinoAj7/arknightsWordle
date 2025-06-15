<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index()
    {
        return Character::all();
    }

    public function show($id)
    {
        return Character::findOrFail($id);
    }

    public function store(Request $request)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            return response()->json(['message' => 'Acceso denegado'], 403);
        }

        $validated = $request->validate([
            'image' => 'required|string', 
            'name' => 'required|string|max:255',
            'faction' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'archetype' => 'required|string|max:255',
            'rarity' => 'required|integer|min:1|max:6',
            'dp_cost' => 'required|integer|min:1',
        ]);

        $character = Character::create($validated);

        if ($request->wantsJson()) {
            return response()->json($character, 201);
        }

        return redirect()->route('admin.characters.index')->with('success', 'Personaje creado');
    }

    public function update(Request $request, $id)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            return response()->json(['message' => 'Acceso denegado'], 403);
        }

        $character = Character::findOrFail($id);
        $character->update($request->all());

        if ($request->wantsJson()) {
            return response()->json($character);
        }

        return redirect()->route('admin.characters.index')->with('success', 'Personaje actualizado');
    }

    public function destroy(Request $request, $id)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            return response()->json(['message' => 'Acceso denegado'], 403);
        }
        
        $character = Character::findOrFail($id);
        $character->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Personaje eliminado']);
        }

        return redirect()->route('admin.characters.index')->with('success', 'Personaje eliminado');
    }

    public function indexView()
    {
        $characters = Character::all();
        return view('admin.characters.index', compact('characters'));
    }

    public function editView($id)
    {
        $character = Character::findOrFail($id);
        return view('admin.characters.edit', compact('character'));
    }

    public function createView()
    {
        return view('admin.characters.create');
    }
}