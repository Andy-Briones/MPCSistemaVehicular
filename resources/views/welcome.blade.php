
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Tu CSS personalizado --}}
    <style>
        body {
            background: linear-gradient(135deg, #1a1a1a, #2c2c2c);
            color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        /* SEPARACIÓN LIMPIA ENTRE NAVBAR Y TÍTULO */
        .titulo-principal {
            margin-top: 60px; /* 👈 Ajusta esta separación */
            text-align: center;
        }

        .titulo-principal h2 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: #58a6ff;
            text-transform: uppercase;
        }

        /* Logo */
        .logo-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .logo-image {
            max-width: 240px;
            transition: 0.3s;
        }

        .logo-image:hover {
            transform: scale(1.05);
        }
    </style>

</head>
<body>
    @auth
        @if (Auth::user()->rol === 'trabajador')
            @include('forms', ['Modo' => 'Encabezado'])
        @elseif (Auth::user()->rol === 'trabajador')
            @include('forms', ['Modo' => 'Encabezado'])
        @endif
    @endauth

    <div class="register-link">
            <a href="{{ route('register') }}">¿No tienes cuenta? Regístrate aquí</a>
    </div>
    
    <!-- Encabezado -->
    <div class="titulo-principal">
        <h2>🚗 Sistema de control vehicular del Área de Patrimonio</h2>
    </div>
    
    {{-- LOGO CENTRADO --}}
    <div class="logo-container">
        <img src="{{ asset('Imgs/logoCaja.png') }}" class="logo-image" alt="Logo Municipalidad">
    </div>

    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>

