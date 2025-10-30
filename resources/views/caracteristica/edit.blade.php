<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Caracteristica</title>
</head>
<body>
    <div class="container mt-4">
    <form action="{{route('caracteristicas.update', $caracteristica->id)}}" method="POST" enctype="multipart/form-data"
        class="p-4 bg-white shadow rounded">
        @csrf
        @include('forms', ['Modo' => 'editarCarac'])
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary me-2">💾 Guardar</button>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">⬅️ Regresar</a>
        </div>
    </form>
</body>
</html>