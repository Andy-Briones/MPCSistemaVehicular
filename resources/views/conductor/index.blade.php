<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Conductores</title>
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
    h3 {
        font-size: 1.9rem;
        font-weight: 700;
        color: #58a6ff;
        text-shadow: 0 0 5px rgba(88,166,255,0.5);
    }

    /* Botón agregar */
    .btn-primary {
        background: linear-gradient(135deg, #2385ff, #1260c4);
        border: none;
        font-weight: 600;
        padding: 10px 16px;
        border-radius: 10px;
        transition: 0.25s;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #3d99ff, #1b6de0);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(53,134,255,0.35);
    }

    /* Botón volver */
    .btn-outline-secondary {
        border-radius: 10px;
        font-weight: 600;
        border: 1px solid #30363d;
        color: #d1d7de;
        transition: 0.25s;
    }
    .btn-outline-secondary:hover {
        background-color: #30363d;
        color: #fff;
    }

    /* Tarjeta */
    .card {
        background: rgba(22, 27, 34, 0.92);
        border-radius: 18px;
        border: 1px solid rgba(88,166,255,0.25);
        box-shadow: 0 8px 25px rgba(0,0,0,0.35);
        backdrop-filter: blur(10px);
    }

    /* Tabla */
    table {
        color: #d1d7de;
    }

    thead.table-dark {
        background: #0d1117 !important;
        color: #58a6ff !important;
        border-bottom: 2px solid #2385ff;
    }

    tbody tr {
        transition: 0.25s;
    }

    tbody tr:hover {
        background: rgba(88,166,255,0.07);
    }

    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: rgba(255,255,255,0.03);
    }

    /* Botón editar */
    .btn-warning {
        background: linear-gradient(135deg, #f0ad4e, #c97d14);
        border: none;
        padding: 5px 12px;
        font-weight: 600;
        border-radius: 8px;
        transition: 0.25s;
    }
    .btn-warning:hover {
        opacity: 0.9;
        transform: translateY(-2px);
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

    /* Alertas de vencimiento */
    .alert-warning {
        background: rgba(255,193,7,0.15);
        border-left: 4px solid #ffc107;
        color: #f1c40f;
        backdrop-filter: blur(2px);
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 0 10px rgba(255,193,7,0.2);
    }

    .alert-warning h5 {
        font-weight: 700;
        margin-bottom: 10px;
        color: #ffdd57;
    }

    .badge {
        font-size: 0.75rem;
        padding: 5px 8px;
    }
</style>

</head>
<body>
@auth
        @if (Auth::user()->role === 'admin')
            {{-- Navbar ADMIN --}}
            @include('forms', ['Modo' => 'Encabezado'])

        @elseif (Auth::user()->role === 'trabajador')
            {{-- Navbar CLIENTE --}}
            @include('forms', ['Modo' => 'Encabezado'])
        @endif
    @endauth
{{-- Alertas --}}
    @if (!empty($alerta))
        <div class="alert alert-warning">
            <h5>⚠️ Avisos de Vencimiento Próximo</h5>
            <ul class="mb-0">
                @foreach ($alerta as $alertass)
                    <li class="{{ isset($alertass['vencido']) ? 'text-danger fw-bold' : '' }}">
                        <strong>{{ $alertass['Licencia'] }}</strong> Licencia
                        <b>{{ $alertass['conductor'] }}</b> de Conductor
                        <b>{{ \Carbon\Carbon::parse($alertass['vence'])->format('d/m/Y') }}</b>
                        <span class="badge {{ $alertass['dias'] > 5 ? 'bg-warning text-dark' : ($alertass['dias'] >= 0 ? 'bg-danger text-white' : 'bg-dark text-white') }}">
                            @if($alertass['dias'] > 0)
                                ⏰ Faltan {{ (int)$alertass['dias'] }} días
                            @elseif($alertass['dias'] == 0)
                                ⚠️ Vence HOY
                            @else
                                ❌ Vencido hace {{ (int)abs($alertass['dias']) }} días
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">📋 Lista de Conductores</h3>
        <a href="{{ url('conductores/create') }}" class="btn btn-primary">
            ➕ Agregar Conductor
        </a>
        <a href="{{ url("/") }}" class="btn btn-outline-secondary">⬅️ Regresar</a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Licencia</th>
                        <th>Categoría</th>
                        <th>Teléfono</th>
                        <th>Fecha de Vencimiento de Licencia</th>
                        <th>Área</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mpcsconductors as $index => $conductor)
                    <tr>
                        <td>{{ $mpcsconductors->firstItem() + $index }}</td>
                        <td>{{ $conductor->nombre }}</td>
                        <td>{{ $conductor->dni }}</td>
                        <td>{{ $conductor->licencia }}</td>
                        <td>{{ $conductor->categoriaLicencia }}</td>
                        <td>{{ $conductor->telefono }}</td>
                        <td>{{ $conductor->vencimientoLice }}</td>
                        <td>{{ $conductor->area }}</td>
                        <td class="text-center">
                            <a href="{{ url('conductores/'.$conductor->id.'/edit') }}" class="btn btn-sm btn-warning">
                                ✏️ Editar
                            </a>
                            <form action="{{ url('conductores/'.$conductor->id) }}" method="POST"
                                  style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                {{--  <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Seguro que deseas eliminar este conductor?')">
                                    🗑️ Eliminar
                                </button>  --}}
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay conductores registrados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $mpcsconductors->links() }}
    </div>

</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>