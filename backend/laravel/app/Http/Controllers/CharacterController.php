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

        return response()->json($character, 201);
    }

    public function update(Request $request, $id)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            return response()->json(['message' => 'Acceso denegado'], 403);
        }

        $character = Character::findOrFail($id);
        $character->update($request->all());

        return $character;
    }

    public function destroy($id)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            return response()->json(['message' => 'Acceso denegado'], 403);
        }
        
        $character = Character::findOrFail($id);
        $character->delete();

        return response()->json(['message' => 'Personaje eliminado']);
    }
}

