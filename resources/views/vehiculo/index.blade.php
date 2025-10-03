<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehiculo</title>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">🚗 Lista de Vehículos</h3>
        <a href="{{ url('vehiculos/create') }}" class="btn btn-primary">➕ Nuevo Vehículo</a>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">⬅️ Cancelar</a>
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mpcsvehiculos as $vehiculos)
                            <tr>
                                <td>{{ $vehiculos->id }}</td>
                                <td>{{ $vehiculos->categoria }}</td>
                                <td>{{ $vehiculos->marca }}</td>
                                <td>{{ $vehiculos->modelo }}</td>
                                <td>{{ $vehiculos->placaActual }}</td>

                                {{-- Característica --}}
                                <td>{{ $vehiculos->caracteristica->nombre ?? 'N/A' }}</td>
                                
                                {{-- Conductor --}}
                                <td>{{ $vehiculos->conductor->nombre ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ url('vehiculos/'.$vehiculos->id.'/edit') }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                                    {{--  <form action="{{ url('vehiculos/'.$vehiculo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este vehículo?')">🗑️ Eliminar</button>
                                    </form>  --}}
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