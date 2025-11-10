<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Revisiones</title>
    @vite(['resources/css/controlfile/controlindex.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    {{-- Alertas --}}
    @if (!empty($alerta))
        <div class="alert alert-warning">
            <h5>⚠️ Avisos de Vencimiento Próximo</h5>
            <ul class="mb-0">
                @foreach ($alerta as $alertass)
                    <li class="{{ isset($alertass['vencido']) ? 'text-danger fw-bold' : '' }}">
                        <strong>{{ $alertass['tipo'] }}</strong> del vehículo
                        <b>{{ $alertass['vehiculo'] }}</b> vence el
                        <b>{{ \Carbon\Carbon::parse($alertass['vence'])->format('d/m/Y') }}</b>
                        <span
                            class="badge {{ $alertass['dias'] > 5 ? 'bg-warning text-dark' : ($alertass['dias'] >= 0 ? 'bg-danger text-white' : 'bg-dark text-white') }}">
                            @if($alertass['dias'] > 0)
                                ⏰ Faltan {{ (int) $alertass['dias'] }} días
                            @elseif($alertass['dias'] == 0)
                                ⚠️ Vence HOY
                            @else
                                ❌ Vencido hace {{ (int) abs($alertass['dias']) }} días
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container mt-4">

        {{-- Título --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Lista de Revisiones</h2>
            <a href="{{ route('controles.create') }}" class="btn btn-primary">➕ Agregar Revisión</a>
        </div>
        <form action="{{ route('controles.index') }}" method="GET" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Buscar por placa"
                value="{{ request('search') }}">
            <a href="{{ url('/')}}" class="btn btn-outline-secondary">⬅️ Regresar</a>
            <button type="submit" class="btn btn-primary">🔍 Buscar</button>
        </form>

        {{-- Tabla de Controles --}}
        <div class="card shadow mb-4 border-0">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Revisiones Registradas</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Vehículo</th>
                            <th>Soat Inicial</th>
                            <th>Soat Vencimiento</th>
                            <th>Revisión Inicial</th>
                            <th>Revisión Vencimiento</th>
                            <th>Tarjeta</th>
                            <th>Lugar de Destino</th>
                            <th>Conductor</th>
                            <th>Imagen Soat</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mpcscontrols as $ctrl)
                            <tr>
                                <td>{{ $ctrl->id }}</td>
                                <td>{{ $ctrl->vehiculo->placaActual ?? '-' }}</td>
                                <td>{{ $ctrl->soatInicial }}</td>
                                <td>{{ $ctrl->soatFinal }}</td>
                                <td>{{ $ctrl->revisionTecIn }}</td>
                                <td>{{ $ctrl->revisionTecFin }}</td>
                                <td>{{ $ctrl->tarjetaP }}</td>
                                <td>{{ $ctrl->lugarD }}</td>
                                <td>{{ $ctrl->vehiculo->conductor->nombre}}</td>
                                <td>
                                    @if ($ctrl->imagenSoat)
                                        <img src="{{ $ctrl->imagenSoat }}" alt="SOAT" width="120" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('controles.edit', $ctrl->id) }}" class="btn btn-sm btn-warning">✏️</a>
                                    <a href="{{ route('controles.preview', $ctrl->id) }}" class="btn btn-sm btn-info">Vista
                                        previa</a>
                                    <a href="{{ route('controles.descargarword', $ctrl->id) }}"
                                        class="btn btn-sm btn-success">Descargar</a>
                                    {{-- <form action="{{ route('control.destroy', $ctrl->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Eliminar este registro?')">🗑️</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No hay revisiones registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Paginación --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $mpcscontrols->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>