<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista previa - Tarjeta Vehicular</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .card {
            max-width: 900px;
            margin: 40px auto;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            background: white;
        }
        .card-header {
            text-align: center;
            background-color: #004aad;
            color: white;
            padding: 20px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            font-size: 18px;
            font-weight: bold;
        }
        .section-title {
            background: #dee2e6;
            font-weight: bold;
            padding: 6px 10px;
            margin-top: 20px;
            border-radius: 5px;
        }
        .table th {
            width: 30%;
            background: #f8f9fa;
            font-weight: 600;
        }
        .table td {
            background: #fff;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            TARJETA DE IDENTIFICACIÓN VEHICULAR ELECTRÓNICA
        </div>
        <div class="card-body p-4">
            
            {{-- DATOS DEL VEHÍCULO --}}
            <div class="section-title">Datos del Vehículo</div>
            <table class="table table-bordered mb-4">
                <tr><th>Placa Actual</th><td>{{ $vehiculo->placaActual }}</td></tr>
                <tr><th>Placa Anterior</th><td>{{ $vehiculo->placaAnterior }}</td></tr>
                <tr><th>Categoría</th><td>{{ $vehiculo->categoria }}</td></tr>
                <tr><th>Marca</th><td>{{ $vehiculo->marca }}</td></tr>
                <tr><th>Modelo</th><td>{{ $vehiculo->modelo }}</td></tr>
                <tr><th>Versión</th><td>{{ $vehiculo->version }}</td></tr>
                <tr><th>Color</th><td>{{ $vehiculo->color }}</td></tr>
                <tr><th>Número de Motor</th><td>{{ $vehiculo->numeroMotor }}</td></tr>
                <tr><th>Número VIN</th><td>{{ $vehiculo->numeroVin }}</td></tr>
                <tr><th>Carrocería</th><td>{{ $vehiculo->carroceria }}</td></tr>
                <tr><th>Combustible</th><td>{{ $vehiculo->combustible }}</td></tr>
                <tr><th>Potencia</th><td>{{ $vehiculo->potencia }}</td></tr>
                <tr><th>Condición</th><td>{{ $vehiculo->condicion }}</td></tr>
                <tr><th>Año Fabricación</th><td>{{ $vehiculo->añoFabricacion }}</td></tr>
                <tr><th>Año Modelo</th><td>{{ $vehiculo->añoModelo }}</td></tr>
                <tr><th>Forma Rodante</th><td>{{ $vehiculo->formrod }}</td></tr>
            </table>

            {{-- CARACTERÍSTICAS --}}
            <div class="section-title">Características Técnicas</div>
            <table class="table table-bordered mb-4">
                <tr><th>Nombre</th><td>{{ $vehiculo->caracteristica->nombre ?? '-' }}</td></tr>
                <tr><th>Asientos</th><td>{{ $vehiculo->caracteristica->asientos ?? '-' }}</td></tr>
                <tr><th>Pasajeros</th><td>{{ $vehiculo->caracteristica->pasajeros ?? '-' }}</td></tr>
                <tr><th>Ruedas</th><td>{{ $vehiculo->caracteristica->ruedas ?? '-' }}</td></tr>
                <tr><th>Ejes</th><td>{{ $vehiculo->caracteristica->ejes ?? '-' }}</td></tr>
                <tr><th>Cilindros</th><td>{{ $vehiculo->caracteristica->cilindros ?? '-' }}</td></tr>
                <tr><th>Cilindrada</th><td>{{ $vehiculo->caracteristica->cilindrada ?? '-' }}</td></tr>
                <tr><th>Peso Neto</th><td>{{ $vehiculo->caracteristica->pesoNeto ?? '-' }}</td></tr>
                <tr><th>Peso Bruto</th><td>{{ $vehiculo->caracteristica->pesoBruto ?? '-' }}</td></tr>
                <tr><th>Carga Útil</th><td>{{ $vehiculo->caracteristica->cargaUtil ?? '-' }}</td></tr>
                <tr><th>Longitud</th><td>{{ $vehiculo->caracteristica->longitud ?? '-' }} m</td></tr>
                <tr><th>Altura</th><td>{{ $vehiculo->caracteristica->altura ?? '-' }} m</td></tr>
                <tr><th>Ancho</th><td>{{ $vehiculo->caracteristica->ancho ?? '-' }} m</td></tr>
            </table>

            {{-- CONDUCTOR --}}
            <div class="section-title">Datos del Conductor</div>
            <table class="table table-bordered mb-4">
                <tr><th>Nombre</th><td>{{ $vehiculo->conductor->nombre ?? '-' }}</td></tr>
                <tr><th>Area</th><td>{{ $vehiculo->conductor->area ?? '-' }}</td></tr>
                <tr><th>Teléfono</th><td>{{ $vehiculo->conductor->telefono ?? '-' }}</td></tr>
                <tr><th>Licencia</th><td>{{ $vehiculo->conductor->licencia ?? '-' }}</td></tr>
                <tr><th>Categoria Licencia</th><td>{{ $vehiculo->conductor->categoriaLicencia ?? '-' }}</td></tr>
            </table>

            <div class="text-center mt-4">
                <a href="{{ route('controles.descargarword', $vehiculo->id) }}" class="btn btn-success">⬇️ Descargar Word</a>
                <a href="{{ route('controles.index') }}" class="btn btn-secondary">⬅️ Volver</a>
            </div>
        </div>

        <div class="footer mb-3">
            © 2025 Registro Vehicular | Documento generado automáticamente
        </div>
    </div>
</body>
</html>
