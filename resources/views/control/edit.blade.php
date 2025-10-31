<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Revision</title>
    @vite(['resources/css/controlfile/controlindex.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <form action="{{route('controles.update', $control->id)}}" method="POST" enctype="multipart/form-data"
            class="p-4 bg-white shadow rounded">
            @csrf
            @method('PUT')
            @include('forms', ['Modo' => 'editarControl'])
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">💾 Guardar</button>
                <a href="{{ route('controles.descargarword', $control->id) }}" class="btn btn-primary">
                    Descargar Tarjeta Vehicular
                </a>
                <a href="{{ url('/controles') }}" class="btn btn-outline-secondary">⬅️ Regresar</a>
            </div>
        </form>
    </div>
</body>
</html>