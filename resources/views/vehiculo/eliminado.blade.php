<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehiculos de Baja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ======== ESTILO GENERAL ======== */
body {
    background: radial-gradient(circle at top, #1f2731, #111418 65%);
        color: #e1e7ee;
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        padding-top: 20px;
}

/* Contenedor general */
.container {
    margin-top: 40px;
}

/* ======== TITULOS DE PÁGINAS ======== */
.container h3 {
    font-weight: 700;
    color: #0d6efd;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* ======== BOTONES ======== */
.btn {
    font-weight: 600;
    border-radius: 8px;
    padding: 8px 16px;
}

.btn-primary {
    background-color: #0d6efd;
    border: none;
}

.btn-primary:hover {
    background-color: #0b5ed7;
}

.btn-outline-secondary {
    border-radius: 8px;
    font-weight: 600;
}

.btn-warning {
    font-weight: 600;
}

.btn-success {
    font-weight: 600;
}

/* ======== TABLAS ======== */
.table {
    margin: 0;
    border-radius: 6px;
    overflow: hidden;
}

.table thead {
    background: #212529 !important;
    color: white;
}

.table-striped tbody tr:nth-child(odd) {
    background: #f8f9fa;
}

.table-striped tbody tr:hover {
    background: #e8eef7;
    transition: 0.2s ease-in-out;
}

/* ======== TARJETAS ======== */
.card {
    border-radius: 10px;
}

.card-body {
    padding: 0;
}

/* ALERTAS */
.alert-warning {
    border-radius: 10px;
    font-size: 15px;
}

/* BADGES (ESTADOS) */
.badge {
    padding: 6px 10px;
    font-size: 0.9rem;
    border-radius: 6px;
}

/* ======== NAVBAR (si se deforma) ======== */
.navbar {
    z-index: 1000;
    padding: 12px 20px !important;
}

.navbar-brand {
    font-size: 20px;
    font-weight: 700;
    color: #ffffff !important;
}

.navbar-nav .nav-link {
    color: white !important;
    font-weight: 500;
    margin-right: 12px;
}

.navbar-nav .nav-link:hover {
    color: #ffc107 !important;
}

/* ======== RESPONSIVE ======== */
@media (max-width: 768px) {
    .d-flex {
        flex-direction: column;
        gap: 15px;
    }

    h3 {
        text-align: center;
    }
}

    </style>
</head>
<body>
@auth
        @if (Auth::user()->role === 'trabajador')
            {{-- Navbar ADMIN --}}
            @include('forms', ['Modo' => 'Encabezado'])

        @elseif (Auth::user()->role === 'trabajador')
            {{-- Navbar CLIENTE --}}
            @include('forms', ['Modo' => 'Encabezado'])
        @endif
    @endauth
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">🚗 Lista de Baja de Vehiculos</h3>
        <a href="{{ url("/") }}" class="btn btn-outline-secondary">⬅️ Regresar</a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Categoría</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Placa</th>
                            <th>Característica</th>
                            <th>Conductor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mpcsvehiculos as $vehiculo)
                            <tr>
                                <td>{{ $vehiculo->id }}</td>
                                <td>{{ $vehiculo->categoria }}</td>
                                <td>{{ $vehiculo->marca }}</td>
                                <td>{{ $vehiculo->modelo }}</td>
                                <td>{{ $vehiculo->placaActual }}</td>

                                {{-- Característica --}}
                                <td>{{ $vehiculo->caracteristica->nombre ?? 'N/A' }}</td>
                                
                                {{-- Conductor --}}
                                <td>{{ $vehiculo->conductor->nombre ?? 'N/A' }}</td>
                                <td>
                                    @if ($vehiculo->Estado == 'inactivo')
                                        <span class="badge bg-danger" >Inactivo</span>
                                    @elseif ($vehiculo->Estado == 'activo')
                                        <span class="badge bg-success" >Activo</span>
                                    @elseif ($vehiculo->Estado == 'mantenimiento')
                                        <span class="badge bg-warning" >Mantenimiento</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('vehiculos.restaurar', $vehiculo->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">Restaurar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No hay vehículos en lista de bajas 🚫</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $mpcsvehiculos->links() }}
    </div>
</div>
</body>
</html>