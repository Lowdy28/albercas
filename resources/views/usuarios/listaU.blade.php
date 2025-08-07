@extends('adminlte::page')

@section('title', 'Lista de Usuarios')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('css')
<style>
    .btn-action {
        min-width: 90px;          /* ancho fijo igual */
        padding: 6px 12px;
        font-size: 1rem;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        transition: background-color 0.3s ease, transform 0.15s ease;
        vertical-align: middle;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-edit {
        background-color: #0d6efd;
        border: none;
        color: white;
        margin-right: 8px;  /* separación derecha */
    }

    .btn-edit:hover {
        background-color: #084cd6;
        transform: scale(1.05);
    }

    .btn-delete {
        background-color: #dc3545;
        border: none;
        color: white;
    }

    .btn-delete:hover {
        background-color: #a52834;
        transform: scale(1.05);
    }
</style>
@stop

@section('content')
    <form method="GET" action="{{ route('usuarios') }}" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar usuario..." class="form-control" />
    </form>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                @switch($usuario->rol)
                                    @case('Administrador')
                                        <span class="badge bg-danger">Administrador</span>
                                        @break
                                    @case('Profesor')
                                        <span class="badge bg-primary">Profesor</span>
                                        @break
                                    @case('Cliente')
                                        <span class="badge bg-success">Cliente</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $usuario->rol }}</span>
                                @endswitch
                            </td>
                            <td>
                                <a href="{{ url('/usuarios/editar/' . $usuario->id) }}" class="btn btn-action btn-edit" title="Editar">
                                    <i class="bi bi-pencil-fill me-1"></i> Editar
                                </a>
                                <form action="{{ url('/usuarios/eliminar/' . $usuario->id) }}" method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action btn-delete" title="Eliminar"
                                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        <i class="bi bi-trash-fill me-1"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $usuarios->withQueryString()->links() }}
            </div>
        </div>
    </div>
@stop
