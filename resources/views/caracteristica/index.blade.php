<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Característica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ===============================
   FONDO GENERAL
=============================== */
body {
    background: linear-gradient(135deg, #0b1b2b, #123a56);
    font-family: 'Inter', sans-serif;
    padding-bottom: 40px;
}

/* ===============================
   TITULO Y HEADER
=============================== */
.container h3 {
    font-weight: 700;
    color: #ffffff;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    margin-bottom: 10px;
}

/* ===============================
   BOTÓN REGRESAR
=============================== */
.btn-outline-secondary {
    border-radius: 8px;
    padding: 10px 20px;
    color: #fff;
    border-color: #cfd8dc;
}

.btn-outline-secondary:hover {
    background-color: #cfd8dc;
    color: #000;
}

/* ===============================
   BOTÓN PRIMARIO (Agregar)
=============================== */
.btn-primary {
    background: linear-gradient(135deg, #0066ff, #004bb7);
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #004bb7, #003b94);
}

/* ===============================
   TARJETA / CARD
=============================== */
.card {
    border-radius: 15px;
    overflow: hidden;
    border-left: 5px solid #007bff;
    border-right: 5px solid #00bcd4;
}

/* ===============================
   TABLA
=============================== */
.table {
    margin-bottom: 0;
}

.table thead.table-dark {
    background: linear-gradient(135deg, #003b70, #005fa3);
    border-bottom: 3px solid #007bff;
}

.table-striped tbody tr:nth-of-type(odd) {
    background: rgba(255, 255, 255, 0.85);
}

.table-striped tbody tr:nth-of-type(even) {
    background: rgba(240, 248, 255, 0.85);
}

.table td, .table th {
    vertical-align: middle;
    padding: 10px;
    font-size: 0.9rem;
}

/* ===============================
   BOTONES DE ACCIÓN
=============================== */
.btn-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    border: none;
}

.btn-danger {
    background: linear-gradient(135deg, #d9534f, #b52b27);
    border: none;
}

/* ===============================
   ETIQUETAS / BADGES
=============================== */
.badge {
    padding: 8px 12px;
    font-size: 0.85rem;
    border-radius: 8px;
}

.badge.bg-danger {
    background: #d9534f !important;
}

.badge.bg-success {
    background: #28a745 !important;
}

.badge.bg-warning {
    background: #ffc107 !important;
    color: black !important;
}

/* ===============================
   PAGINACIÓN
=============================== */
.pagination .page-link {
    color: #0b1b2b;
    border-radius: 8px;
}

.pagination .page-link:hover {
    background-color: #007bff;
    color: white;
}

.pagination .active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

/* ===============================
   SOMBRAS Y EFECTOS
=============================== */
.card.shadow {
    box-shadow: 0 6px 15px rgba(0,0,0,0.25) !important;
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
    <div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">⚙️ Lista de Características</h3>
        <a href="{{ url('caracteristicas/create') }}" class="btn btn-primary">
            ➕ Agregar Característica
        </a>
        <a href="{{ url("/") }}" class="btn btn-outline-secondary">⬅️ Regresar</a>
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