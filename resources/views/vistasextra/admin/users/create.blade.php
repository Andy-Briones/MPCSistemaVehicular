<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Aridetalles</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Estilos -->


    @auth
        @if (Auth::user()->role === 'admin')
            {{-- Navbar ADMIN --}}
            @include('forms', ['Modo' => 'Encabezado'])

        @elseif (Auth::user()->role === 'trabajador')
            {{-- Navbar CLIENTE --}}
            @include('forms', ['Modo' => 'Encabezado'])
        @endif
    @endauth
</head>

<body>
<!-- CONTENIDO -->
<div class="container">
    <div class="register-card">
        <h1 class="register-title">
            Crear Cuenta
        </h1>
        @if(session('success'))
            <div class="alert-custom alert-success-custom">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-custom alert-error-custom">
                <strong>Por favor corrige los siguientes errores:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,100}" title="Solo letras, mínimo 3 caracteres">
                </div>

                <div class="form-group">
                    <label for="surname">Apellido</label>
                    <input type="text" name="surname" id="surname" value="{{ old('surname') }}" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,100}" title="Solo letras, mínimo 3 caracteres">
                </div>

                <div class="form-group full">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group full">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" required minlength="8" title="Mínimo 8 caracteres">
                </div>

                <div class="form-group full">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8" title="Debe coincidir con la contraseña anterior">
                </div>
            </div>

            <button type="submit" class="btn-custom btn-success-custom">
                Registrarse
            </button>
        </form>
    </div>
</div>
</body>
</html>