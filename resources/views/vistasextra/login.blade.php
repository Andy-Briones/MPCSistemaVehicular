<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <!-- Fuentes -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <!-- Estilos -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top, #1f2731, #111418 60%);
            color: #dce3ea;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Contenedor general */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            padding: 20px;
        }

        /* Tarjeta de login */
        .login-card {
            background: rgba(22, 27, 34, 0.9);
            padding: 40px 45px;
            width: 100%;
            max-width: 420px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(88, 166, 255, 0.25);
            backdrop-filter: blur(10px);
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Títulos */
        .login-title {
            font-size: 1.9rem;
            font-weight: 700;
            color: #58a6ff;
            text-align: center;
            margin-bottom: 5px;
        }

        .login-subtitle {
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 25px;
            color: #9aa4af;
        }

        /* Inputs */
        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.95rem;
            font-weight: 500;
            color: #d0d8e0;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            background: #0d1117;
            border: 1px solid #30363d;
            border-radius: 10px;
            color: #c9d1d9;
            font-size: 0.95rem;
            transition: 0.25s;
        }

        input:focus {
            border-color: #58a6ff;
            outline: none;
            box-shadow: 0 0 6px rgba(88, 166, 255, 0.6);
        }

        /* Botón */
        .btn-custom {
            width: 100%;
            padding: 12px;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.25s;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #2385ff, #1260c4);
            color: white;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #3c9bff, #1a6ed8);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(53, 134, 255, 0.35);
        }

        /* Alertas */
        .alert-custom {
            padding: 12px;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-bottom: 15px;
            text-align: center;
        }

        .alert-error-custom {
            background-color: rgba(255, 71, 71, 0.15);
            border: 1px solid rgba(255, 71, 71, 0.4);
            color: #ff6b6b;
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
    <!-- HEADER -->
    <header class="header">
    </header>

    <!-- CONTENIDO -->
    <div class="container">
        <div class="login-card">
            <h1 class="login-title">
                Iniciar Sesión
            </h1>
            <p class="login-subtitle">
                Accede a tu cuenta para gestionar vehiculos.
            </p>

            @if(session('error'))
                <div class="alert-custom alert-error-custom">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="text">Usuario</label>
                    <input type="text" name="name" id="name" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <button type="submit" class="btn-custom btn-primary-custom">
                    Iniciar Sesión
                </button>
            </form>
        </div>
    </div>

    <a class="btn alert-primary bg-danger" href="{{ url('/') }}">Atras</a>
</body>

</html>