<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mt-4">

    {{-- Título --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Revisiones</h2>
        <a href="{{ route('controles.create') }}" class="btn btn-primary">➕ Agregar Revisión</a>
    </div>
    <form action="{{ route('controles.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Buscar por placa" value="{{ request('search') }}">
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
                        <th>Soat Final</th>
                        <th>Revisión Inicial</th>
                        <th>Revisión Final</th>
                        <th>Tarjeta</th>
                        <th>Lugar</th>
                        <th>Conductor</th>
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
                                <a href="{{ route('controles.edit', $ctrl->id) }}" class="btn btn-sm btn-warning">✏️</a>
                                {{--  <form action="{{ route('control.destroy', $ctrl->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este registro?')">🗑️</button>
                                </form>  --}}
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
</body>
</html>