<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('perfil.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);
        
        $user = Auth::user();
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente');
    }

    public function cambiarPassword(Request $request)
    {
        $request->validate([
            'password_actual' => 'required',
            'password_nueva' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_actual, $user->password)) {
            return back()->with('error', 'La contraseña actual no es correcta');
        }

        $user->password = Hash::make($request->password_nueva);
        $user->save();

        return back()->with('success', 'Contraseña actualizada correctamente');
    }
}
