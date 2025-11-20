
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(135deg, #1a1a1a, #2c2c2c);
        color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .titulo-principal {
        margin-top: 60px;
        text-align: center;
    }

    .titulo-principal h2 {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: #58a6ff;
        text-transform: uppercase;
    }

    /* CONTENEDOR DE IMAGEN + BOTÓN */
    .hero-box {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 40px; /* separación entre imagen y botón */
        flex-wrap: wrap; /* responsive 🔥 */
    }

    .logo-image {
        max-width: 240px;
        transition: 0.3s;
    }

    .logo-image:hover {
        transform: scale(1.05);
    }

    .register-link a {
        padding: 12px 20px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 10px;
        transition: 0.3s;
        color: white !important;
        border: none;
    }

    .register-link a:hover {
        transform: scale(1.05);
        background-color: #198754 !important;
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
        @else
        <div class="hero-box">
            <img src="{{ asset('Imgs/logoCaja.png') }}" class="logo-image" alt="Logo Municipalidad">

            {{--  Boton de registro  --}}
            <div class="register-link">
                <a class="btn bg-success" href="{{ route('register') }}">
                    Registrarse
                </a>
            </div>
            <div class="register-link">
                <a class="btn bg-success" href="{{ route('login') }}">
                    Iniciar Sesion
                </a>
            </div>
        </div>
    @endauth

    
    <!-- Encabezado -->
    <div class="titulo-principal">
        <h2>🚗 Sistema de control vehicular del Área de Patrimonio</h2>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>

