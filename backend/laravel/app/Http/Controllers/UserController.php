<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Para API: listar todos usuarios en JSON
    public function index()
    {
        return response()->json(User::all());
    }

    // Para API: ver un usuario en JSON
    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    // Para API + Web: crear usuario (solo admin)
    public function store(Request $request)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            return response()->json(['message' => 'Acceso denegado'], 403);
        }

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->wantsJson()) {
            return response()->json($user, 201);
        }

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado');
    }

    // Para API + Web: actualizar usuario (solo admin)
    public function update(Request $request, $id)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            return response()->json(['message' => 'Acceso denegado'], 403);
        }

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'sometimes|string|max:255|unique:users,username,' . $id,
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        if ($request->wantsJson()) {
            return response()->json($user);
        }

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado');
    }

    // Para API + Web: eliminar usuario (solo admin)
    public function destroy(Request $request, $id)
    {
        if (!$request->user() || !$request->user()->is_admin) {
            return response()->json(['message' => 'Acceso denegado'], 403);
        }

        User::destroy($id);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Usuario eliminado']);
        }

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado');
    }

    // Para Web: vista lista usuarios (admin)
    public function indexView()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Para Web: vista formulario editar usuario (admin)
    public function editView($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function createView()
    {
        return view('admin.users.create');
    }

    public function dashboard()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized access');
        }
    
        return view('admin.dashboard');
    }
}