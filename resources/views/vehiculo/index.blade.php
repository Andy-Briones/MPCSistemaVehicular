<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vehiculos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: radial-gradient(circle at top, #1f2731, #111418 65%);
        color: #e1e7ee;
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        padding-top: 20px;
    }

    /* Título */
    .page-title {
        font-size: 1.9rem;
        font-weight: 700;
        color: #58a6ff;
        text-shadow: 0 0 4px rgba(88,166,255,0.5);
    }

    /* Botones superiores */
    .btn-primary {
        background: linear-gradient(135deg, #2385ff, #1260c4);
        border: none;
        font-weight: 600;
        padding: 10px 16px;
        border-radius: 10px;
        transition: 0.25s;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #3c9bff, #1a6ed8);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(53,134,255,0.35);
    }

    .btn-outline-secondary {
        border-radius: 10px;
        font-weight: 600;
        transition: 0.25s;
    }
    .btn-outline-secondary:hover {
        background-color: #30363d;
        color: #fff;
    }

    /* Tarjeta principal */
    .card {
        background: rgba(22, 27, 34, 0.9);
        border-radius: 18px;
        border: 1px solid rgba(88,166,255,0.25);
        box-shadow: 0 8px 25px rgba(0,0,0,0.35);
        backdrop-filter: blur(10px);
    }

    /* Tabla */
    table {
        color: #d1d7de !important;
    }

    thead.table-dark {
        background: #0d1117 !important;
        color: #58a6ff !important;
        border-bottom: 2px solid #2385ff;
    }

    tbody tr {
        transition: background 0.2s;
    }

    tbody tr:hover {
        background: rgba(88,166,255,0.07);
    }

    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: rgba(255,255,255,0.03);
    }

    /* Botones en acciones */
    .btn-warning {
        background: linear-gradient(135deg, #f0ad4e, #c97d14);
        border: none;
        padding: 5px 10px;
        font-weight: 600;
        border-radius: 8px;
        transition: 0.25s;
    }
    .btn-warning:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    /* Paginación */
    .pagination .page-link {
        background: #0d1117;
        color: #58a6ff;
        border: 1px solid #30363d;
    }

    .pagination .page-item.active .page-link {
        background: #2385ff;
        color: white;
        border-color: #2385ff;
    }

    .pagination .page-link:hover {
        background: #1b222c;
        color: #79b8ff;
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