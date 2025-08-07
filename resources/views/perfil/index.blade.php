@extends('adminlte::page')

@section('title', 'Mi Perfil')

@section('content_header')
    <h1>Mi Perfil</h1>
@stop

@section('content')
    @if (session('success'))
        <x-adminlte-alert theme="success" title="Éxito">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    @if (session('error'))
        <x-adminlte-alert theme="danger" title="Error">
            {{ session('error') }}
        </x-adminlte-alert>
    @endif

    <div class="row">
        <!-- DATOS PERSONALES -->
        <div class="col-md-6">
            <x-adminlte-card title="Editar Datos Personales" theme="primary" icon="fas fa-user-edit">
                <form action="{{ route('perfil.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input name="nombre" value="{{ $user->name }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input name="email" value="{{ $user->email }}" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </x-adminlte-card>
        </div>

        <!-- CAMBIAR CONTRASEÑA -->
        <div class="col-md-6">
            <x-adminlte-card title="Cambiar Contraseña" theme="warning" icon="fas fa-key">
                <form action="{{ route('perfil.password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="password_actual">Contraseña actual</label>
                        <input type="password" name="password_actual" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password_nueva">Nueva contraseña</label>
                        <input type="password" name="password_nueva" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password_nueva_confirmation">Confirmar nueva contraseña</label>
                        <input type="password" name="password_nueva_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-warning">Actualizar Contraseña</button>
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop
