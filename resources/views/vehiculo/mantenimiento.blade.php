<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehiculos en Mantenimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ===============================
   FONDO GENERAL
=============================== */
body {
    background: linear-gradient(135deg, #0b1b2b, #123a56);
    font-family: 'Inter', sans-serif;
    padding-bottom: 40px;
}

/* ===============================
   TITULO Y HEADER
=============================== */
.container h3 {
    font-weight: 700;
    color: #ffffff;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

/* ===============================
   BOTÓN REGRESAR
=============================== */
.btn-outline-secondary {
    border-radius: 8px;
    padding: 10px 20px;
    color: #fff;
    border-color: #cfd8dc;
}

.btn-outline-secondary:hover {
    background-color: #cfd8dc;
    color: #000;
}

/* ===============================
   TARJETA / CARD
=============================== */
.card {
    border-radius: 15px;
    overflow: hidden;
    border-left: 5px solid #007bff;
    border-right: 5px solid #00bcd4;
}

/* ===============================
   TABLA
=============================== */
.table {
    margin-bottom: 0;
}

.table thead.table-dark {
    background: linear-gradient(135deg, #003b70, #005fa3);
    border-bottom: 3px solid #007bff;
}

.table-striped tbody tr:nth-of-type(odd) {
    background: rgba(255, 255, 255, 0.8);
}

.table-striped tbody tr:nth-of-type(even) {
    background: rgba(240, 248, 255, 0.8);
}

.table td, .table th {
    vertical-align: middle;
    padding: 12px;
}

/* ===============================
   ETIQUETAS / BADGES
=============================== */
.badge {
    padding: 8px 12px;
    font-size: 0.9rem;
    border-radius: 8px;
}

.badge.bg-danger {
    background: #d9534f !important;
}

.badge.bg-success {
    background: #28a745 !important;
}

/* ===============================
   BOTÓN RESTAURAR
=============================== */
.btn-success {
    background: linear-gradient(135deg, #28a745, #1c7c32);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(135deg, #1c7c32, #155a24);
}

/* ===============================
   PAGINACIÓN
=============================== */
.pagination .page-link {
    color: #0b1b2b;
    border-radius: 8px;
}

.pagination .page-link:hover {
    background-color: #007bff;
    color: white;
}

.pagination .active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

/* ===============================
   SOMBRAS Y EFECTOS
=============================== */
.card.shadow {
    box-shadow: 0 6px 15px rgba(0,0,0,0.25) !important;
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
        <h3 class="mb-0">🚗 Lista de Vehiculos en Mantenimiento</h3>
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
                                    @if ($vehiculo->Estado == 'mantenimiento')
                                        <span class="badge bg-danger" >Mantenimiento</span>
                                    @elseif ($vehiculo->Estado == 'activo')
                                        <span class="badge bg-success" >Activo</span>
                                    @elseif ($vehiculo->Estado == 'inactivo')
                                        <span class="badge bg-success" >Inactivo</span>
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
                                <td colspan="8" class="text-center">No hay vehículos en lista de mantenimineto 🚫</td>
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
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>