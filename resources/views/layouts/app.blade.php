@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('content')
    @can('admin')
        {{-- DASHBOARD PARA ADMIN --}}
        <div class="row">
            <div class="col-md-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalUsuarios }}</h3>
                        <p>Total de Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalClases }}</h3>
                        <p>Total de Clases</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>${{ $totalPagos }}</h3>
                        <p>Total Pagado</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">Resumen Mensual</div>
            <div class="card-body">
                <canvas id="graficaAdmin"></canvas>
            </div>
        </div>
    @endcan

    @can('profesor')
        {{-- DASHBOARD PARA PROFESOR --}}
        <div class="card">
            <div class="card-header">Tus Clases Asignadas</div>
            <div class="card-body">
                <p>Total de clases asignadas: <strong>{{ $totalClasesProfesor }}</strong></p>
                <canvas id="graficaClasesProfe"></canvas>
            </div>
        </div>
    @endcan

    @can('usuario')
        {{-- DASHBOARD PARA CLIENTE --}}
        <div class="card">
            <div class="card-header">Resumen de Membresía</div>
            <div class="card-body">
                <p><strong>Clases disponibles:</strong> {{ $membresia->clases_disponibles }}</p>
                <p><strong>Clases ocupadas:</strong> {{ $membresia->clases_ocupadas }}</p>
                <canvas id="graficaCliente"></canvas>
            </div>
        </div>
    @endcan
@stop

@push('js')
    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @can('admin')
    <script>
        const ctxAdmin = document.getElementById('graficaAdmin').getContext('2d');
        new Chart(ctxAdmin, {
            type: 'bar',
            data: {
                labels: {!! json_encode($meses) !!},
                datasets: [{
                    label: 'Pagos ($)',
                    data: {!! json_encode($pagosPorMes) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
    @endcan

    @can('profesor')
    <script>
        const ctxProfe = document.getElementById('graficaClasesProfe').getContext('2d');
        new Chart(ctxProfe, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril'],
                datasets: [{
                    label: 'Clases asignadas',
                    data: [2, 4, 6, 3],
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
    @endcan

    @can('usuario')
    <script>
        const ctxCliente = document.getElementById('graficaCliente').getContext('2d');
        new Chart(ctxCliente, {
            type: 'doughnut',
            data: {
                labels: ['Disponibles', 'Ocupadas'],
                datasets: [{
                    data: [{{ $membresia->clases_disponibles }}, {{ $membresia->clases_ocupadas }}],
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
            }
        });
    </script>
    @endcan
@endpush
