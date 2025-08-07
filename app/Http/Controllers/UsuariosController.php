<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UsuariosController extends Controller
{
    public function list()
    {
        $usuarios = User::paginate(10);
        return view('usuarios.listaU', compact('usuarios'));
    }

    public function index()
    {
        $usuario = new User();
        return view('usuarios.nuevaU', compact('usuario'));
    }

    public function store(Request $request)
    {
        // Obtener id y validar que sea nulo o número válido
        $id = $request->input('id');
        if (empty($id) || !is_numeric($id)) {
            $id = null;
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . ($id ?? 'NULL'),
            // Contraseña requerida solo si es nuevo usuario
            'password' => $id ? 'nullable|string|min:6' : 'required|string|min:6',
            'rol'      => 'required|in:Administrador,Cliente,Profesor',
        ]);

        if ($id) {
            $usuario = User::findOrFail($id);
            $accion = 'actualizado';
        } else {
            $usuario = new User();
            $accion = 'creado';
        }

        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if (!empty($request->password)) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->rol = $request->rol;
        $usuario->save();

        Log::channel('usuarios')->info("Usuario {$accion}", [
            'por_usuario'       => $this->userLogInfo(),
            'usuario_objetivo'  => $usuario->only('id', 'name', 'email', 'rol')
        ]);

        return redirect()->route('usuarios');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.nuevaU', compact('usuario'));
    }

    public function destroy($id)
    {
        $authUser = Auth::user();
        $usuario = User::findOrFail($id);
        $usuarioInfo = $usuario->only('id', 'name', 'email', 'rol');
        $usuario->delete();

        Log::channel('usuarios')->warning('Usuario eliminado', [
            'por_usuario'       => $authUser->only('id', 'name', 'email', 'rol'),
            'usuario_eliminado' => $usuarioInfo
        ]);

        return redirect()->route('usuarios');
    }

    private function userLogInfo()
    {
        if (auth()->check()) {
            return [
                'id'    => auth()->id(),
                'name'  => auth()->user()->name,
                'rol'   => auth()->user()->rol,
                'email' => auth()->user()->email
            ];
        }

        return ['tipo' => 'guest'];
    }
}
