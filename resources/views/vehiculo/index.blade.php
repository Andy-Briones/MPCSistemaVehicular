<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vehiculos</title>
    @vite(['resources/css/vehiculofile/vehiculoindex.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">🚗 Lista de Vehículos</h3>
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
</body>
</html>