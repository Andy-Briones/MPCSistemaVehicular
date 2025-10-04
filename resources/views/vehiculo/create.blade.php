{{--  <div class="container mt-4">
    <form action="{{url('/vehiculos')}}" method="POST" enctype="multipart/form-data"
        class="p-4 bg-white shadow rounded">
        @csrf
        @include('forms', ['Modo' => 'crearV'])
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary me-2">💾 Guardar</button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">⬅️ Cancelar</a>
        </div>
    </form>
</div>  --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vehículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        h3 {
            text-align: center;
            margin-top: 20px;
            color: #343a40;
        }

        .form-container {
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .form-container:hover {
            transform: translateY(-3px);
        }

        .form-header {
            margin-bottom: 20px;
            font-size: 1.2rem;
            font-weight: 600;
            color: #0d6efd;
            text-align: center;
        }

        .btn-primary, .btn-outline-secondary {
            width: 120px;
        }

        /* Estilo para el formulario flotante de características */
        #formCaracFloating {
            position: fixed;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
            width: 400px;
            max-width: 90%;
            z-index: 1050;
            display: none; /* inicialmente oculto */
        }

        #formCaracFloating .close-btn {
            position: absolute;
            top: 8px;
            right: 12px;
            cursor: pointer;
            font-size: 1.2rem;
            color: #dc3545;
        }

    </style>
</head>
<body>

<h3>⚙️ Gestión de Vehículos</h3>

<div class="container mt-4">
    <div class="row g-4">
        <!-- Botón para abrir formulario flotante -->
        <div class="col-12 text-center mb-4">
            <button id="btnOpenCarac" class="btn btn-primary">➕ Agregar Característica</button>
        </div>

        <!-- Formulario Derecho -->
        <div class="col-lg-12">
            <div class="form-container">
                <div class="form-header">➕ Agregar Vehículo</div>
                <form action="{{url('/vehiculos')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('forms', ['Modo' => 'crearV'])
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary me-2">💾 Guardar</button>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">⬅️ Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Formulario flotante de características -->
<div id="formCaracFloating" class="form-container">
    <span class="close-btn">&times;</span>
    <div class="form-header">➕ Agregar Característica</div>
    <form id="caracFormFloating" action="{{url('/caracteristicas')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('forms', ['Modo' => 'crearCarac'])
        <div class="text-center mt-4">
            <button type="button" id="btnGuardarCarac" class="btn btn-primary me-2">💾 Guardar</button>
            <button type="button" class="btn btn-outline-secondary btnCloseFloating">⬅️ Cancelar</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnOpen = document.getElementById('btnOpenCarac');
    const formFloating = document.getElementById('formCaracFloating');
    const btnClose = formFloating.querySelector('.close-btn');
    const btnCloseCancel = formFloating.querySelector('.btnCloseFloating');
    const btnGuardar = document.getElementById('btnGuardarCarac');

    // Abrir formulario flotante
    btnOpen.addEventListener('click', function() {
        formFloating.style.display = 'block';
    });

    // Cerrar con X
    btnClose.addEventListener('click', function() {
        formFloating.style.display = 'none';
    });

    // Cerrar con cancelar
    btnCloseCancel.addEventListener('click', function() {
        formFloating.style.display = 'none';
    });

    // 🔹 Guardar mediante AJAX
    btnGuardar.addEventListener('click', function() {
        const formData = new FormData(document.getElementById('caracFormFloating'));

        fetch('/caracteristicas', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                formFloating.style.display = 'none';
                alert('Característica guardada correctamente');
                location.reload();
            } else {
                alert('Error al guardar la característica');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al guardar la característica');
        });
    });
});
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

