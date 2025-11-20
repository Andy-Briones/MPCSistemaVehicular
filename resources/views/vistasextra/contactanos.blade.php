<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio Técnico</title>
    
    <!-- Bootstrap -->
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
        margin: 30px 0 20px;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
    }

    /* ===============================
       TARJETA INFORMACIÓN
    =============================== */
    .info-card {
        background: linear-gradient(135deg, #1a1a1a, #2c2c2c);
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.3);
        padding: 30px;
        max-width: 500px;
        margin: 0 auto 50px;
        color: #ffffff;
        text-align: left;
        border-left: 5px solid #007bff;
        border-right: 5px solid #00bcd4;
    }

    .info-card h4 {
        margin-bottom: 15px;
        color: #58a6ff;
    }

    .info-card p {
        margin: 6px 0;
        font-size: 1rem;
    }

    /* ===============================
       ICONOS
    =============================== */
    .info-card i {
        margin-right: 8px;
        color: #00bcd4;
    }

    /* ===============================
       RESPONSIVE
    =============================== */
    @media (max-width: 768px) {
        .info-card {
            padding: 20px;
            margin: 20px;
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

    <div class="container">
        <h2>🛠️ Servicio Técnico</h2>
        <div class="info-card">
            <h4>Información de Contacto</h4>
            <p><i class="bi bi-person-fill"></i> Nombre: Andy Briones</p>
            <p><i class="bi bi-envelope-fill"></i> Correo: gabryelb027@gmail.com</p>
            <p><i class="bi bi-telephone-fill"></i> Teléfono: 980608001</p>
            <p><i class="bi bi-person-fill"></i> Practicante Ing. Sistemas Comutacionales 8to Ciclo</p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>
