@extends('adminlte::page')

@section('title', 'Nuevo Usuario')

@section('content_header')
    <h1>Nuevo Usuario</h1>
@stop

@section('content')
    <form action="{{ route('usuarios.store') }}" method="post">
        @csrf
        {{-- Enviar id solo si es edición --}}
        @if(!empty($usuario->id))
            <input type="hidden" name="id" value="{{ $usuario->id }}">
        @endif

        <div class="form-group">
            <div class="row">
                <!-- Nombre -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Nombre del usuario" value="{{ $usuario->name ?? '' }}" required>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Correo del usuario" value="{{ $usuario->email ?? '' }}" required>
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Contraseña" {{ empty($usuario->id) ? 'required' : '' }}>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <select name="rol" id="rol" class="form-control select2" required>
                            <option value="">Selecciona un rol</option>
                            <option value="Administrador" {{ (isset($usuario->rol) && $usuario->rol == 'Administrador') ? 'selected' : '' }}>Administrador</option>
                            <option value="Cliente" {{ (isset($usuario->rol) && $usuario->rol == 'Cliente') ? 'selected' : '' }}>Cliente</option>
                            <option value="Profesor" {{ (isset($usuario->rol) && $usuario->rol == 'Profesor') ? 'selected' : '' }}>Profesor</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12 mt-3">
                    <button type="submit" class="btn btn-warning">Guardar</button>
                </div>
            </div>
        </div>
    </form>
@stop
