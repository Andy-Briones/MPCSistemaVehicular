<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Revisiones</title>
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
   ENCABEZADO / TITULO
=============================== */
.container h2 {
    text-align: center;
    font-weight: 700;
    color: #58a6ff;
    margin: 25px 0 20px;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
}

/* ===============================
   TARJETA / FORMULARIO
=============================== */
form {
    background: linear-gradient(135deg, #ffffff, #e0e0e0);
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.25);
    padding: 30px;
    max-width: 700px;
    margin: 0 auto 50px;
    color: #0b1b2b;
}

/* ===============================
   LABELS E INPUTS
=============================== */
form label {
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
}

form input,
form select,
form textarea {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #007bff;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

form input:focus,
form select:focus,
form textarea:focus {
    outline: none;
    border-color: #00bcd4;
    box-shadow: 0 0 8px rgba(0, 188, 212, 0.5);
}

/* ===============================
   BOTONES
=============================== */
.btn-primary {
    background: linear-gradient(135deg, #007bff, #00bcd4);
    border: none;
    border-radius: 8px;
    padding: 10px 25px;
    font-weight: 600;
    color: #fff;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #005fa3, #0097a7);
}

.btn-outline-secondary {
    border-radius: 8px;
    padding: 10px 25px;
    border: 1px solid #cfd8dc;
    background-color: #ffffff;
    color: #0b1b2b;
    font-weight: 600;
    transition: all 0.3s ease;
    margin-left: 10px;
}

.btn-outline-secondary:hover {
    background-color: #cfd8dc;
    color: #000;
}

/* ===============================
   RESPONSIVE
=============================== */
@media (max-width: 768px) {
    form {
        padding: 20px;
        margin: 20px;
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
    <div class="container mt-4">
        <form action="{{url('/controles')}}" method="POST" enctype="multipart/form-data"
            class="p-4 bg-white shadow rounded">
            @csrf
            @include('forms', ['Modo' => 'crearControl'])
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">💾 Guardar</button>
                <a href="{{ url('/controles')}}" class="btn btn-outline-secondary">⬅️ Cancelar</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
