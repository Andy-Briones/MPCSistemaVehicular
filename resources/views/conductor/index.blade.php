<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Conductores</title>
    @vite(['resources/css/conductorfile/conductorindex.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                        <th>Licencia</th>
                        <th>Categoría</th>
                        <th>Teléfono</th>
                        <th>Área</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mpcsconductors as $index => $conductor)
                    <tr>
                        <td>{{ $mpcsconductors->firstItem() + $index }}</td>
                        <td>{{ $conductor->nombre }}</td>
                        <td>{{ $conductor->licencia }}</td>
                        <td>{{ $conductor->categoriaLicencia }}</td>
                        <td>{{ $conductor->telefono }}</td>
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

</body>
</html>