<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehiculos en Mantenimiento</title>
     @vite(['resources/css/vehiculofile/vehiculoindex.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('forms', ['Modo' => 'Encabezado'])
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