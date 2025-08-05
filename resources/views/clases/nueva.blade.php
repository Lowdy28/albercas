@extends('adminlte::page')

@section('title', 'Nueva Clase')

@section('content_header')
    <h1>Nueva Clase</h1>
@stop

@section('content')
    <form action="{{ route('clases.guardar') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $clase->id ?? '' }}">

        <div class="form-group">
            <div class="row">
                <!-- Fecha -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="fecha"
                            value="{{ $clase->fecha ?? '' }}" required>
                    </div>
                </div>

                <!-- Profesor -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="id_profesor">Profesor</label>
                        <select name="id_profesor" id="id_profesor" class="form-control select2" required>
                            <option value="">Selecciona un Profesor</option>
                            @foreach($profesores as $profesor)
                                <option value="{{ $profesor->id }}"
                                    {{ (isset($clase) && $clase->id_profesor == $profesor->id) ? 'selected' : '' }}>
                                    {{ $profesor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Tipo -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" class="form-control" name="tipo" id="tipo"
                            placeholder="Tipo de clase" value="{{ $clase->tipo ?? '' }}" required>
                    </div>
                </div>

                <!-- Lugares -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="lugares">Lugares</label>
                        <input type="number" class="form-control" name="lugares" id="lugares"
                            placeholder="Número total de lugares" min="1" value="{{ $clase->lugares ?? '' }}" required>
                    </div>
                </div>

                <!-- Lugares Ocupados -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="lugares_ocupados">Lugares Ocupados</label>
                        <input type="number" class="form-control" name="lugares_ocupados" id="lugares_ocupados"
                            placeholder="Lugares ocupados" min="0" value="{{ $clase->lugares_ocupados ?? 0 }}">
                    </div>
                </div>

                <!-- Lugares Disponibles -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="lugares_disponibles">Lugares Disponibles</label>
                        <input type="number" class="form-control" name="lugares_disponibles" id="lugares_disponibles"
                            placeholder="Lugares disponibles" min="0" value="{{ $clase->lugares_disponibles ?? '' }}">
                    </div>
                </div>

                <!-- Botón Guardar -->
                <div class="col-lg-12 mt-3">
                    <button type="submit" class="btn btn-warning">Guardar</button>
                </div>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const lugaresInput = document.getElementById("lugares");
            const ocupadosInput = document.getElementById("lugares_ocupados");
            const disponiblesInput = document.getElementById("lugares_disponibles");

            function actualizarDisponibles() {
                const total = parseInt(lugaresInput.value) || 0;
                const ocupados = parseInt(ocupadosInput.value) || 0;
                const disponibles = Math.max(total - ocupados, 0);
                disponiblesInput.value = disponibles;
            }

            lugaresInput.addEventListener("input", actualizarDisponibles);
            ocupadosInput.addEventListener("input", actualizarDisponibles);
        });
    </script>
@stop
