@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2 class="fw-bold">Bienvenido, {{ auth()->user()->name }}</h2>
    </div>

    {{-- ADMINISTRADOR --}}
    @if(auth()->user()->rol === 'Administrador')
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total de Usuarios</h5>
                        <p class="display-4">{{ $totalUsuarios }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total de Profesores</h5>
                        <p class="display-4">{{ $totalProfesores }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total de Clientes</h5>
                        <p class="display-4">{{ $totalClientes }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gráfica de Usuarios por Rol --}}
        <div class="card mt-4">
            <div class="card-header">Distribución de Usuarios por Rol</div>
            <div class="card-body">
                <canvas id="adminChart" height="100"></canvas>
            </div>
        </div>

        @section('js')
        <script>
            const adminChart = document.getElementById('adminChart');
            new Chart(adminChart, {
                type: 'bar',
                data: {
                    labels: ['Administradores', 'Profesores', 'Clientes'],
                    datasets: [{
                        label: 'Cantidad',
                        data: [{{ $totalUsuarios - ($totalProfesores + $totalClientes) }}, {{ $totalProfesores }}, {{ $totalClientes }}],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        </script>
        @endsection

    {{-- PROFESOR --}}
    @elseif(auth()->user()->rol === 'Profesor')
        <div class="card">
            <div class="card-header">Tus Clases Programadas</div>
            <div class="card-body">
                @if($clasesProfe->count() > 0)
                    <ul class="list-group mb-3">
                        @foreach($clasesProfe as $clase)
                            <li class="list-group-item">
                                <strong>{{ $clase->nombre }}</strong> – {{ \Carbon\Carbon::parse($clase->fecha)->format('d/m/Y H:i') }}
                            </li>
                        @endforeach
                    </ul>
                    <canvas id="clasesProfeChart" height="100"></canvas>
                @else
                    <p>No tienes clases programadas.</p>
                @endif
            </div>
        </div>

        @section('js')
        <script>
            const fechas = @json($clasesProfe->pluck('fecha')->map(function($fecha) {
                return \Carbon\Carbon::parse($fecha)->format('d/m/Y');
            }));
            const conteos = {};

            fechas.forEach(fecha => {
                conteos[fecha] = (conteos[fecha] || 0) + 1;
            });

            new Chart(document.getElementById('clasesProfeChart'), {
                type: 'line',
                data: {
                    labels: Object.keys(conteos),
                    datasets: [{
                        label: 'Clases Programadas',
                        data: Object.values(conteos),
                        fill: false,
                        borderColor: '#007bff',
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        </script>
        @endsection

    {{-- CLIENTE --}}
    @elseif(auth()->user()->rol === 'Cliente')
        <div class="card">
            <div class="card-header">Tu Membresía</div>
            <div class="card-body">
                @if($membresia)
                    <ul class="list-group mb-3">
                        <li class="list-group-item">Clases adquiridas: <strong>{{ $membresia->clases_adquiridas }}</strong></li>
                        <li class="list-group-item">Clases disponibles: <strong>{{ $membresia->clases_disponibles }}</strong></li>
                        <li class="list-group-item">Clases ocupadas: <strong>{{ $membresia->clases_ocupadas }}</strong></li>
                    </ul>
                    <a href="{{ route('clases.disponibles') }}" class="btn btn-success mb-3">Reservar Nueva Clase</a>

                    <canvas id="membresiaChart" height="100"></canvas>
                @else
                    <p>No tienes una membresía activa.</p>
                    <a href="{{ route('membresias.comprar') }}" class="btn btn-primary">Comprar Membresía</a>
                @endif
            </div>
        </div>

        @if($membresia)
        @section('js')
        <script>
            new Chart(document.getElementById('membresiaChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Disponibles', 'Ocupadas'],
                    datasets: [{
                        data: [{{ $membresia->clases_disponibles }}, {{ $membresia->clases_ocupadas }}],
                        backgroundColor: ['#28a745', '#dc3545'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                    },
                }
            });
        </script>
        @endsection
        @endif
    @endif
</div>
@endsection
