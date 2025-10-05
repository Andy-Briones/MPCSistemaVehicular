
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    {{-- Tu CSS personalizado --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Encabezado -->
    <div class="container mt-4 text-center">
        <h2 class="fw-bold text-primary">🚗 Sistema de Registro Vehicular</h2>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-3">
        <div class="container">
            <a class="navbar-brand text-center" href="#">Sistema interno de control vehicular Unidad de Patrimonio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">🔑 Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">📞 Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Opciones principales -->
    <div class="container mt-5 text-center">
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ url('/vehiculos')}}" class="btn btn-primary w-100 py-3 shadow">🚘 Vehículos</a>
            </div>
            <div class="col-md-4">
                <a href="{{ url('/conductores')}}" class="btn btn-success w-100 py-3 shadow">👷 Conductores</a>
            </div>
            <div class="col-md-4">
                <a href="{{ url('/caracteristicas')}}" class="btn btn-warning w-100 py-3 shadow">⚙️ Características</a>
            </div>
            <div class="col-md-4">
                <a href="{{ url('/controles')}}" class="btn btn-warning w-100 py-3 shadow">⚙️ Revisión</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>

