{{-- <div class="container mt-4">
    <form action="{{url('/vehiculos')}}" method="POST" enctype="multipart/form-data"
        class="p-4 bg-white shadow rounded">
        @csrf
        @include('forms', ['Modo' => 'crearV'])
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary me-2">💾 Guardar</button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">⬅️ Cancelar</a>
        </div>
    </form>
</div> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vehículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* === Estilo general para la vista de Gestión de Vehículos === */
        body {
            background: linear-gradient(135deg, #0a0f1f, #1f2a44, #2e3b55);
            color: #e5e5e5;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Título principal */
        h3 {
            text-align: center;
            color: #00b4d8;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-shadow: 0 0 15px rgba(0, 180, 216, 0.6);
            margin-top: 30px;
        }

        /* Contenedor general */
        .container {
            background: rgba(255, 255, 255, 0.05);
            padding: 35px;
            border-radius: 16px;
            backdrop-filter: blur(10px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.4);
        }

        /* Tarjeta / formulario */
        .form-container {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(0, 180, 216, 0.3);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 180, 216, 0.15);
            position: relative;
            animation: fadeIn 0.6s ease-in-out;
        }

        /* Encabezado del formulario */
        .form-header {
            background: linear-gradient(90deg, #1a1a1a, #00334e);
            color: #00b4d8;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 12px 12px 0 0;
            padding: 12px 20px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 180, 216, 0.4);
        }

        /* Botones */
        .btn-primary {
            background: linear-gradient(90deg, #007bff, #00b4d8);
            border: none;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(0, 180, 216, 0.4);
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #00b4d8, #007bff);
            transform: scale(1.05);
        }

        .btn-outline-secondary {
            color: #ccc;
            border-color: #555;
            transition: 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #555;
            color: #fff;
        }

        /* === Formulario flotante === */
        #formCaracFloating {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(15, 20, 35, 0.95);
            border: 2px solid #00b4d8;
            border-radius: 16px;
            padding: 30px;
            z-index: 999;
            width: 90%;
            max-width: 1200px;
            box-shadow: 0 0 25px rgba(0, 180, 216, 0.5);
            animation: slideIn 0.5s ease;
        }

        /* Botón cerrar flotante */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 1.8rem;
            color: #ff4b2b;
            cursor: pointer;
            transition: 0.3s;
        }

        .close-btn:hover {
            color: #fff;
            transform: scale(1.2);
        }

        /* Campos del formulario */
        form input,
        form select,
        form textarea {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #00b4d8;
            color: #f5f5f5;
            border-radius: 8px;
            transition: 0.3s ease;
        }

        form input:focus,
        form select:focus,
        form textarea:focus {
            outline: none;
            box-shadow: 0 0 10px #00b4d8;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        /* Efecto en hover del formulario principal */
        .form-container:hover {
            box-shadow: 0 0 25px rgba(0, 180, 216, 0.4);
            transition: 0.4s ease;
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
    <h3>⚙️ Gestión de Vehículos</h3>

    <div class="container mt-4">
        <div class="row g-4">
            <!-- Formulario Derecho -->
            <div class="col-lg-12">
                <div class="form-container">
                    <!-- Botón para abrir formulario flotante -->
                    <div class="col-12 text-center mb-4">
                        <button id="btnOpenCarac" class="btn btn-primary">➕ Agregar Característica</button>
                    </div>
                    <form action="{{url('/vehiculos')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('forms', ['Modo' => 'crearV'])
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary me-2">💾 Guardar</button>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary">⬅️ Cancelar</a>
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
        document.addEventListener('DOMContentLoaded', function () {
            const btnOpen = document.getElementById('btnOpenCarac');
            const formFloating = document.getElementById('formCaracFloating');
            const btnClose = formFloating.querySelector('.close-btn');
            const btnCloseCancel = formFloating.querySelector('.btnCloseFloating');
            const btnGuardar = document.getElementById('btnGuardarCarac');

            // Abrir formulario flotante
            btnOpen.addEventListener('click', function () {
                formFloating.style.display = 'block';
            });

            // Cerrar con X
            btnClose.addEventListener('click', function () {
                formFloating.style.display = 'none';
            });

            // Cerrar con cancelar
            btnCloseCancel.addEventListener('click', function () {
                formFloating.style.display = 'none';
            });

            // 🔹 Guardar mediante AJAX
            btnGuardar.addEventListener('click', function () {
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
                        if (data.success) {
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


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>