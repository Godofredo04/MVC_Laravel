<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsersController extends Controller
{
    /**
     * Display a listing of users (solo para admins)
     */
    public function index()
    {
        // Verificar que el usuario es admin
        if (!auth()->user()->is_admin) {
            abort(403, 'No tienes permisos para acceder a esta sección.');
        }

        $usersList = User::orderBy('created_at', 'desc')->paginate(15);
        return view('users', compact('usersList'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        return view('createUser');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_admin' => ['boolean']
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $request->has('is_admin') ? true : false,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado con éxito.');
    }

    /**
     * Display the specified user
     */
    public function show($id)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the user
     */
    public function edit($id)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $user = User::findOrFail($id);
        return view('editUser', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'is_admin' => ['boolean']
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        // Solo actualizar password si se proporciona uno nuevo
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        
        $user->is_admin = $request->has('is_admin') ? true : false;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    /**
     * Remove the specified user
     */
    public function destroy($id)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $user = User::findOrFail($id);

        // Evitar que el admin se elimine a sí mismo
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito.');
    }
}