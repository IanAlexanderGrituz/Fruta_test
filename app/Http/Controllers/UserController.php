<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect('/')->with([
        'mensaje' => 'Registro correcto',
        'usuario' => $user->name,
    ]);
}

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return redirect('/')->withErrors(['email' => 'Las credenciales son incorrectas.']);
    }

    $user = Auth::user();

    return redirect('/')->with([
        'mensaje' => 'Login correcto',
        'usuario' => $user->name,
    ]);
}

public function logout(Request $request)
{
    Auth::logout();
    return redirect('/')->with('mensaje', 'Logout correcto');
}

}