@extends('adminlte::page')
@section('title', 'lista')

@section('content_header')
    <h1>Lista de Usuarios </h1>
@endsection

@section('content')

<div class="card">
<div class="card-body">

    <table id="users-table" class="table table-striped table-bordered">

        <thead>
            <tr>

            <th>ID</th>
            <th>Cliente</th>
            <th>Clases Adquiridas</th>
            <th>Clases Disponibles</th>
            <th>Clases Ocupadas</th>
            <th>Acciones</th>

            </tr>


</thead>

<tbody>

    @foreach($membresias as $membresia)
    <tr>
        <td>{{$membresia -> id}}</td>
        <td>{{$membresia -> name}}</td>
        <td>{{$membresia -> clases_adquiridas}}</td>
        <td>{{$membresia -> clases_disponibles}}</td>
        <td>{{$membresia -> clases_ocupadas}}</td>
         <td>
        <a href="{{ url('/membresias/' . $membresia->id . '/edit')}}" class="btn btn-warning btn-sm">Editar</a>
        <form action="{{ url('/membresias/' . $membresia->id )}}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
        </form>
        </td>
    </tr>


    </tr>
     @endforeach
</tbody>
</table>
</div>
</div>
@endsection
