<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Característica</title>
    @vite(['resources/css/caracteristicafiles/caracteristicaindex.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">⚙️ Lista de Características</h3>
        <a href="{{ url('caracteristicas/create') }}" class="btn btn-primary">
            ➕ Agregar Característica
        </a>
        <a href="{{ url("/") }}" class="btn btn-outline-secondary">⬅️ Cancelar</a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Asientos</th>
                        <th>Pasajeros</th>
                        <th>Ruedas</th>
                        <th>Ejes</th>
                        <th>Cilindros</th>
                        <th>Longitud</th>
                        <th>Altura</th>
                        <th>Ancho</th>
                        <th>Cilindrada</th>
                        <th>Peso Bruto</th>
                        <th>Peso Neto</th>
                        <th>Carga Útil</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mpcscaracteristicas as $index => $caracteristica)
                    <tr>
                        <td>{{ $mpcscaracteristicas->firstItem() + $index }}</td>
                        <td>{{ $caracteristica->asientos }}</td>
                        <td>{{ $caracteristica->pasajeros }}</td>
                        <td>{{ $caracteristica->ruedas }}</td>
                        <td>{{ $caracteristica->ejes }}</td>
                        <td>{{ $caracteristica->cilindros }}</td>
                        <td>{{ $caracteristica->longitud }}</td>
                        <td>{{ $caracteristica->altura }}</td>
                        <td>{{ $caracteristica->ancho }}</td>
                        <td>{{ $caracteristica->cilindrada }}</td>
                        <td>{{ $caracteristica->pesoBruto }}</td>
                        <td>{{ $caracteristica->pesoNeto }}</td>
                        <td>{{ $caracteristica->cargaUtil }}</td>
                        <td class="text-center">
                            <a href="{{ url('caracteristicas/'.$caracteristica->id.'/edit') }}" class="btn btn-sm btn-warning">
                                ✏️ Editar
                            </a>
                            <form action="{{ url('caracteristicas/'.$caracteristica->id) }}" method="POST"
                                  style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Seguro que deseas eliminar esta característica?')">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="14" class="text-center text-muted">No hay características registradas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $mpcscaracteristicas->links() }}
    </div>

</div>
</body>
</html>