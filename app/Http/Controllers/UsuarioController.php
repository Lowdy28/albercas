<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UsuariosController extends Controller
{
    /**
     * Muestra la lista de todos los usuarios.
     */
    public function list()
    {
        $usuarios = User::all();
        return view('usuarios.lista', compact('usuarios'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function index()
    {
        $usuario = new User();
        $roles = ['usuario', 'profesor', 'admin'];
        return view('usuarios.nuevo', compact('usuario', 'roles'));
    }

    /**
     * Crea un nuevo usuario desde el formulario.
     */
    public function crear(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'rol'      => 'required|in:usuario,profesor,admin',
        ]);

        $nuevo = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'rol'      => $request->rol,
        ]);

        Log::channel('usuarios')->info('Usuario creado', [
            'por_usuario'     => $this->userLogInfo(),
            'nuevo_usuario'   => $nuevo->only('id', 'name', 'email', 'rol')
        ]);

        // Devolvemos el formulario vacío otra vez
        $usuario = new User();
        $roles = ['usuario', 'profesor', 'admin'];
        return view('usuarios.nuevo', compact('usuario', 'roles'));
    }

    /**
     * Guarda un usuario, ya sea nuevo o existente (update).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $request->id,
            'password' => 'nullable|string|min:6',
            'rol'      => 'required|in:usuario,profesor,admin',
        ]);

        if ($request->id > 0) {
            $usuario = User::find($request->id);
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

    /**
     * Muestra el formulario con los datos del usuario a editar.
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = ['usuario', 'profesor', 'admin'];
        return view('usuarios.nuevo', compact('usuario', 'roles'));
    }

    /**
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        $auhtUser = Auth::user();
        $usuario = User::findOrFail($id);
        $usuarioInfo = $usuario->only('id', 'name', 'email', 'rol');
        $usuario->delete();

        Log::channel('usuarios')->warning('Usuario eliminado', [
            'por_usuario'       => $auhtUser,
            'usuario_eliminado' => $usuario
        ]);

        return redirect()->route('usuarios');
    }

    /**
     * Retorna la información del usuario autenticado para el log.
     */
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
