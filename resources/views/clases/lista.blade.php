@extends('adminlte::page')

@section('title', 'Lista de Clases')

@section('content_header')
    <h1>Lista de Clases</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('clases.nueva') }}" class="btn btn-success">+ Nueva Clase</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Profesor</th>
                        <th>Tipo</th>
                        <th>Lugares</th>
                        <th>Lugares Ocupados</th>
                        <th>Lugares Disponibles</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clases as $clase)
                        <tr>
                            <td>{{ $clase->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($clase->fecha)->format('d/m/Y') }}</td>
                            <td>{{ $clase->profesor }}</td>
                            <td>{{ $clase->tipo }}</td>
                            <td>{{ $clase->lugares }}</td>
                            <td>{{ $clase->lugares_ocupados }}</td>
                            <td>{{ $clase->lugares_disponibles }}</td>
                            <td>
                                <a href="{{ route('clases.editar', $clase->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('clases.destroy', $clase->id) }}" method="POST" style="display:inline-block;"
                                      onsubmit="return confirm('¿Estás seguro de eliminar esta clase?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay clases registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
