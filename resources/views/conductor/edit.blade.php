<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Conductor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* ===============================
   ESTILO GENERAL
=============================== */
body {
    background: linear-gradient(135deg, #0b1b2b, #123a56);
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
}

/* ===============================
   CONTENEDOR PRINCIPAL
=============================== */
.container {
    margin-top: 40px !important;
}

/* ===============================
   TARJETA DE FORMULARIO
=============================== */
form.bg-white {
    border-radius: 15px;
    border-left: 5px solid #007bff;
    border-right: 5px solid #00bcd4;
    transition: transform .2s ease, box-shadow .2s ease;
}

form.bg-white:hover {
    transform: translateY(-3px);
    box-shadow: 0 0 20px rgba(0, 136, 204, 0.3);
}

/* ===============================
   TITULOS Y SUBTÍTULOS
=============================== */
h1, h2, h3 {
    font-weight: 700;
    color: #0d6efd;
    text-align: center;
    margin-bottom: 20px;
}

/* ===============================
   LABELS
=============================== */
.form-group label,
label {
    font-weight: 600;
    margin-bottom: 5px;
    color: #0b2e4a;
}

/* ===============================
   INPUTS
=============================== */
input[type="text"],
input[type="email"],
input[type="password"],
input[type="file"],
input[type="number"],
select,
textarea {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #cfd8dc;
    background: #f8fbff;
    transition: border-color .2s ease, box-shadow .2s ease;
}

input:focus,
textarea:focus,
select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, .2);
    outline: none;
}

/* ===============================
   BOTONES
=============================== */
.btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
    padding: 12px 25px;
    font-weight: 600;
    border-radius: 8px;
    transition: background .2s ease, transform .2s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, #003f7f);
    transform: scale(1.03);
}

.btn-outline-secondary {
    padding: 12px 25px;
    border-radius: 8px;
    transition: background .2s ease, color .2s ease;
}

.btn-outline-secondary:hover {
    background: #e0e0e0;
    color: #000;
}

/* ===============================
   BOTÓN DE REGRESAR
=============================== */
.btn-back {
    background: #e0e0e0;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
}

/* ===============================
   IMAGENES DE FORMULARIO
=============================== */
.img-preview {
    max-width: 150px;
    border-radius: 10px;
    border: 3px solid #007bff;
    margin-bottom: 15px;
}

/* ===============================
   SOMBRAS
=============================== */
.shadow {
    box-shadow: 0 6px 15px rgba(0,0,0,0.15) !important;
}

    </style>
</head>
<body>
@auth
        @if (Auth::user()->role === 'trabajador')
            {{-- Navbar ADMIN --}}
            @include('forms', ['Modo' => 'Encabezado'])

        @elseif (Auth::user()->role === 'trabajador')
            {{-- Navbar CLIENTE --}}
            @include('forms', ['Modo' => 'Encabezado'])
        @endif
    @endauth
    <div class="container mt-4">
    <form action="{{route('conductores.update', $conductor->id)}}" method="POST" enctype="multipart/form-data"
        class="p-4 bg-white shadow rounded">
        @csrf
        @method('PUT')
        @include('forms', ['Modo' => 'editarConductor'])
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary me-2">💾 Guardar</button>
            <a href="{{ url('/conductores') }}" class="btn btn-outline-secondary">⬅️ Regresar</a>
        </div>
    </form>
</body>
</html>