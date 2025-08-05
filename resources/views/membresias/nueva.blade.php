@extends('adminlte::page')

@section('title', 'Nueva Membresia')

@section('content_header')
    <h1>Nueva Membresia</h1>
@stop

@section('content')
    <form action="{{ route('membresia.guardar') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $membresia->id }}">

        <div class="form-group">
            <div class="row">
                <!-- Selección de Usuario -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="id_usuario">Usuario</label>
                        <select name="id_usuario" id="id_usuario" class="form-control select2">
                            <option value="">Selecciona un Usuario</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}"
                                    {{ $membresia->id_usuario == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Clases Adquiridas -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="clases_adquiridas">Clases Adquiridas</label>
                        <input type="number" class="form-control" name="clases_adquiridas" id="clases_adquiridas"
                            placeholder="Clases Adquiridas" value="{{ $membresia->clases_adquiridas }}" min="1" required>
                    </div>
                </div>

                <!-- Botón Guardar -->
                <div class="col-lg-12">
                    <div class="form-group">
                        <button type="submit" id="save" class="btn btn-warning">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
