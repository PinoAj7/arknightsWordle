<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'sometimes|string|unique:users,username,' . $id,
            'password' => 'sometimes|string|confirmed',
            'is_admin' => 'boolean'
        ]);

        if ($request->has('username')) $user->username = $request->username;
        if ($request->has('password')) $user->password = Hash::make($request->password);
        if ($request->has('is_admin')) $user->is_admin = $request->is_admin;

        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response()->json(['message' => 'Usuario eliminado']);
    }
}
