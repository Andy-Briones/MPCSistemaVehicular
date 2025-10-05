<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/controlfile/controlcreate.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <form action="{{url('/controles')}}" method="POST" enctype="multipart/form-data"
            class="p-4 bg-white shadow rounded">
            @csrf
            @include('forms', ['Modo' => 'crearControl'])
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">💾 Guardar</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">⬅️ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
