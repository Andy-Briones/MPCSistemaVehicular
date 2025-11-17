<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Estilos -->
    
    </style>
</head>

<body>
  @include('forms', ['Modo' => 'Encabezado'])
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
            Accede a tu cuenta para gestionar pedidos y productos.
        </p>

        @if(session('error'))
            <div class="alert-custom alert-error-custom">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" required autofocus>
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


</body>
</html>