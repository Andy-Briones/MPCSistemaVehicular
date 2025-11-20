<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Revisiones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ===============================
   FONDO GENERAL
=============================== */
body {
    background: linear-gradient(135deg, #0b1b2b, #123a56);
    font-family: 'Inter', sans-serif;
    padding-bottom: 40px;
    color: #ffffff;
}

/* ===============================
   TITULO / ENCABEZADO
=============================== */
.container h2 {
    font-weight: 700;
    color: #58a6ff;
    margin: 25px 0;
    text-align: center;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
}

/* ===============================
   ALERTAS
=============================== */
.alert-warning {
    background: #ffeb3b33;
    border-left: 5px solid #ff9800;
    color: #0b1b2b;
}

/* ===============================
   BOTONES
=============================== */
.btn-primary {
    background: linear-gradient(135deg, #007bff, #00bcd4);
    border: none;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-primary:hover {
    background: linear-gradient(135deg, #005fa3, #0097a7);
}

.btn-outline-secondary {
    border-radius: 8px;
    padding: 8px 20px;
    border-color: #cfd8dc;
    color: #fff;
}
.btn-outline-secondary:hover {
    background-color: #cfd8dc;
    color: #000;
}

/* ===============================
   TARJETA / CARD
=============================== */
.card {
    border-radius: 15px;
    border-left: 5px solid #007bff;
    border-right: 5px solid #00bcd4;
    box-shadow: 0 6px 15px rgba(0,0,0,0.25);
}
.card-header {
    background: linear-gradient(135deg, #003b70, #005fa3);
    color: #fff;
    font-weight: 600;
}

/* ===============================
   TABLA
=============================== */
.table thead {
    background: linear-gradient(135deg, #003b70, #005fa3);
    color: #8e4b4bff;
}
.table-striped tbody tr:nth-of-type(odd) {
    background: rgba(255,255,255,0.1);
}
.table-striped tbody tr:nth-of-type(even) {
    background: rgba(255,255,255,0.05);
}
.table td, .table th {
    vertical-align: middle;
    padding: 12px;
    color: #000000ff;
}

/* ===============================
   IMAGEN MINIATURA
=============================== */
.img-thumbnail {
    border-radius: 10px;
    transition: transform 0.3s;
    cursor: pointer;
}
.img-thumbnail:hover {
    transform: scale(1.05);
}

/* ===============================
   PAGINACIÓN
=============================== */
.pagination .page-link {
    border-radius: 8px;
    color: #0b1b2b;
}
.pagination .page-link:hover {
    background-color: #007bff;
    color: white;
}
.pagination .active .page-link {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

/* ===============================
   MODAL IMAGEN
=============================== */
#imagenAmpliada {
    max-width: 100%;
    max-height: 75vh;
    object-fit: contain;
    cursor: zoom-in;
    transition: transform 0.3s;
}

/* ===============================
   RESPONSIVE
=============================== */
@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
    .btn, .btn-primary, .btn-outline-secondary {
        margin-bottom: 8px;
    }
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
            <input type="text" name="search" class="form-control me-2"
           placeholder="Buscar por placa"
           value="{{ request('search') }}">

    <select name="filtro_venc" class="form-select me-2">
        <option value="">Ordenar por vencimiento...</option>
        <option value="soat" {{ request('filtro_venc')=='soat'?'selected':'' }}>SOAT más próximo</option>
        <option value="revision" {{ request('filtro_venc')=='revision'?'selected':'' }}>Revisión Técnica más próxima</option>
    </select>

    <a href="{{ url('/') }}" class="btn btn-outline-secondary me-2">⬅️ Regresar</a>
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
                            <th>Imagen Revision T.</th>
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
                                        <img src="{{ asset($ctrl->imagenSoat) }}" 
                                            alt="SOAT"
                                            width="120"
                                            class="img-thumbnail"
                                            style="cursor:pointer"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalImagen"
                                            onclick="mostrarImagen('{{ asset($ctrl->imagenSoat) }}')">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($ctrl->imagenRev)
                                        <img src="{{ asset($ctrl->imagenRev) }}" 
                                            alt="SOAT"
                                            width="120"
                                            class="img-thumbnail"
                                            style="cursor:pointer"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalImagen"
                                            onclick="mostrarImagen('{{ asset($ctrl->imagenRev) }}')">
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

<!-- Modal Mostrar Imagen -->
<div class="modal fade" id="modalImagen" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Vista de Imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body d-flex justify-content-center align-items-center">
                <img id="imagenAmpliada" src="" 
                     style="max-width:100%; max-height:75vh; object-fit:contain; cursor: zoom-in;"
                     onclick="zoomImagen(this)">
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button class="btn btn-primary" onclick="imprimirImagen()">🖨️ Imprimir</button>
            </div>

        </div>
    </div>
</div>

<script>
function mostrarImagen(src) {
    document.getElementById('imagenAmpliada').src = src;
}

// ZOOM con click
let zoom = false;
function zoomImagen(img) {
    zoom = !zoom;
    img.style.transform = zoom ? "scale(1.8)" : "scale(1)";
    img.style.transition = "0.3s";
}

// IMPRIMIR SOLO LA IMAGEN
function imprimirImagen() {
    const imgSrc = document.getElementById('imagenAmpliada').src;

    const ventana = window.open("", "_blank");
    ventana.document.write(`
        <html>
        <head><title>Imprimir Imagen</title></head>
        <body style="text-align:center; margin:0; padding:0;">
            <img src="${imgSrc}" style="max-width:100%;"/>
            <script>
                window.onload = function() { window.print(); }
            <\/script>
        </body>
        </html>
    `);
    ventana.document.close();
}
</script>

<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>