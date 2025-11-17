<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
   CONTAINER / CARD FORMULARIO
=============================== */
.container form {
    background: linear-gradient(135deg, #ffffff, #e0e0e0);
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.25);
    padding: 30px;
}

/* ===============================
   TÍTULOS DEL FORMULARIO
=============================== */
.container h3, .container h1, .container h2 {
    font-weight: 700;
    color: #0b1b2b;
    text-align: center;
    margin-bottom: 20px;
}

/* ===============================
   LABELS Y INPUTS
=============================== */
.form-group label {
    font-weight: 500;
    color: #0b1b2b;
    margin-bottom: 6px;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #007bff;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
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
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #005fa3, #0097a7);
    color: #fff;
}

.btn-outline-secondary {
    border-radius: 8px;
    padding: 10px 20px;
    color: #0b1b2b;
    border-color: #cfd8dc;
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    background-color: #cfd8dc;
    color: #000;
}

/* ===============================
   TEXT CENTER EN BOTONES
=============================== */
.text-center button, .text-center a {
    margin-top: 10px;
}

/* ===============================
   EFECTO SOMBRA EN BOTONES
=============================== */
.btn {
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

/* ===============================
   RESPONSIVE
=============================== */
@media (max-width: 768px) {
    .container form {
        padding: 20px;
    }
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
        <form action="{{url('/caracteristicas')}}" method="POST" enctype="multipart/form-data"
            class="p-4 bg-white shadow rounded">
            @csrf
            @include('forms', ['Modo' => 'crearCarac'])
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">💾 Guardar</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">⬅️ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
