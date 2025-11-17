<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function create() {
        return view('vistasextra.admin.users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,trabajador',
        ]);

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'Usuario creado correctamente');
    }
    // Mostrar formulario público
    public function showRegisterForm() {
        return view('vistasextra.admin.users.create'); // lo crearemos abajo
    }

    // Registrar usuario
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // usamos confirmation
        ]);

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'trabajador', // fuerza rol de trabajador
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado correctamente. Inicia sesión.');
    }
}
