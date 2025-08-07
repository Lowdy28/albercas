@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Bienvenido, {{ auth()->user()->name }}</h1>

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
    @elseif(auth()->user()->rol === 'Profesor')
        <div class="row">
            {{-- Tarjeta: Total de Clases --}}
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body">
                        <h4 class="card-title">Total de Clases</h4>
                        <p class="display-4">{{ $clasesProfe->count() }}</p>
                    </div>
                </div>
            </div>

            {{-- Tarjeta: Próximos 7 Días --}}
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success h-100">
                    <div class="card-body">
                        <h4 class="card-title">Próximos 7 Días</h4>
                        <p class="display-4">
                            {{
                                $clasesProfe->filter(function($c){
                                    return \Carbon\Carbon::parse($c->fecha)->isBetween(now(), now()->addDays(7));
                                })->count()
                            }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Tarjeta: Clases Impartidas --}}
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-dark h-100">
                    <div class="card-body">
                        <h4 class="card-title">Clases Impartidas</h4>
                        <p class="display-4">
                            {{
                                $clasesProfe->filter(function($c){
                                    return \Carbon\Carbon::parse($c->fecha)->isPast();
                                })->count()
                            }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de Clases --}}
        <div class="card mt-4 mb-5">
            <div class="card-header">Tus Clases Programadas</div>
            <div class="card-body">
                @if($clasesProfe->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Tiempo restante</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clasesProfe->sortBy('fecha') as $clase)
                                    <tr class="
                                        @if(\Carbon\Carbon::parse($clase->fecha)->isPast())
                                            table-secondary
                                        @elseif(\Carbon\Carbon::parse($clase->fecha)->isToday())
                                            table-warning
                                        @else
                                            table-success
                                        @endif
                                    ">
                                        <td>{{ $clase->tipo ?? 'No definido' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($clase->fecha)->format('d/m/Y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($clase->fecha)->diffForHumans(now(), ['locale' => 'es']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No tienes clases programadas.</p>
                @endif
            </div>
        </div>
    @elseif(auth()->user()->rol === 'Cliente')
        {{-- Aquí va el contenido del cliente, no se modifica --}}
    @endif
</div>
@endsection
