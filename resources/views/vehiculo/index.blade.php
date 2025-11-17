<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vehiculos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* ===========================
   FONDO GENERAL
=========================== */
body {
    background: #eef1f7;
    font-family: "Poppins", sans-serif;
}

/* ===========================
   SEPARACIÓN DEL NAVBAR
=========================== */
.container {
    margin-top: 30px;
}

/* ===========================
   TÍTULO CORPORATIVO
=========================== */
.page-title {
    font-weight: 700;
    font-size: 28px;
    color: #1a1f36;
    position: relative;
    padding-left: 14px;
}

.page-title::before {
    content: "";
    position: absolute;
    width: 6px;
    height: 100%;
    background: #0d6efd;
    border-radius: 4px;
    left: 0;
    top: 0;
}

/* ===========================
   BOTONES SUPERIORES
=========================== */
.btn-primary {
    background: #0d6efd !important;
    border: none !important;
    font-weight: 600;
    padding: 10px 16px !important;
    border-radius: 10px !important;
    transition: .2s ease-in-out;
}

.btn-primary:hover {
    transform: translateY(-2px);
    background: #0b5ed7 !important;
}

.btn-outline-secondary {
    font-weight: 600;
    border-radius: 10px !important;
}

/* ===========================
   CARD DEL LISTADO
=========================== */
.card {
    border-radius: 14px !important;
    background: rgba(255, 255, 255, 0.92) !important;
    backdrop-filter: blur(8px) !important;
    box-shadow: 0px 8px 25px rgba(0,0,0,0.08) !important;
}

/* ===========================
   TABLA CORPORATIVA
=========================== */
.table-striped > tbody > tr:nth-of-type(odd) {
    background: #f6f8fc !important;
}

.table thead.table-dark {
    background: #0d6efd !important;
}

.table thead th {
    border: none !important;
    font-size: 14px;
    letter-spacing: .3px;
}

.table tbody td {
    vertical-align: middle !important;
    padding: 12px 10px !important;
    font-size: 14px;
}

/* HOVER PROFESIONAL */
.table tbody tr:hover {
    background: rgba(13,110,253,0.14) !important;
    cursor: pointer;
    transition: .2s ease-in-out;
}

/* ===========================
   BOTONES DE LA TABLA (AMARILLOS)
=========================== */
.btn-warning {
    background: #ffc107 !important;
    color: black !important;
    border: none !important;
    padding: 6px 12px !important;
    border-radius: 6px !important;
    font-weight: 600 !important;
    transition: .2s ease-in-out;
}

.btn-warning:hover {
    background: #e0a800 !important;
    transform: translateY(-2px);
}

/* ===========================
   PAGINACIÓN
=========================== */
.pagination .page-item .page-link {
    color: #0d6efd !important;
    border-radius: 8px !important;
    border: 1px solid #cfd5e1 !important;
    margin: 0 3px;
    padding: 8px 14px !important;
    font-weight: 500;
}

.pagination .page-item.active .page-link {
    background: #0d6efd !important;
    border-color: #0d6efd !important;
    color: white !important;
}

/* ===========================
   RESPONSIVE
=========================== */
@media (max-width: 768px) {
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 12px;
    }
}

    </style>
</head>
<body>
@include('forms', ['Modo' => 'Encabezado'])
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="page-title mb-0">🚗 Lista de Vehículos</h3>
        <a href="{{ url('vehiculos/create') }}" class="btn btn-primary">➕ Nuevo Vehículo</a>
        {{--  <a href="{{ route('vehiculos.eliminado') }}" class="btn btn-secondary">🗑️ Ver Eliminados</a>  --}}
        <a href="{{ url("/") }}" class="btn btn-outline-secondary">⬅️ Regresar</a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Cod. Patrimonial</th>
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
                        @forelse($mpcsvehiculos as $vehiculos)
                            <tr>
                                <td>{{ $vehiculos->id }}</td>
                                <td>{{ $vehiculos->codPatrimonial }}</td>
                                <td>{{ $vehiculos->categoria }}</td>
                                <td>{{ $vehiculos->marca }}</td>
                                <td>{{ $vehiculos->modelo }}</td>
                                <td>{{ $vehiculos->placaActual }}</td>

                                {{-- Característica --}}
                                <td>{{ $vehiculos->caracteristica->nombre ?? 'N/A' }}</td>
                                
                                {{-- Conductor --}}
                                <td>{{ $vehiculos->conductor->nombre ?? 'N/A' }}</td>
                                <td>{{ $vehiculos->Estado }}</td>
                                <td>
                                    <a href="{{ url('vehiculos/'.$vehiculos->id.'/edit') }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                                    <form action="{{ route('vehiculos.eliminar', $vehiculos->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning"> ↓ Dar de Baja</button>
                                    </form>
                                    <form action="{{ route('vehiculos.mantener', $vehiculos->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning"> » Mantenimiento</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No hay vehículos registrados 🚫</td>
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