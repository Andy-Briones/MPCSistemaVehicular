{{-- Caracteristica --}}
@if($Modo == 'crearCarac' || $Modo == 'editarCarac')
<div class="card shadow mb-4 border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">
            {{ $Modo == 'crearCarac' ? '➕ Agregar Características' : '✏️ Modificar Características' }}
        </h4>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                    placeholder="Ingrese el nombre"
                    value="{{ old('nombre') }}">
            </div>
            <div class="col-md-6">
                <label for="asientos" class="form-label">N° Asientos</label>
                <input type="number" name="asientos" id="asientos" class="form-control"
                    placeholder="Ej: 4"
                    value="{{ old('asientos') }}">
            </div>
            <div class="col-md-6">
                <label for="pasajeros" class="form-label">Pasajeros</label>
                <input type="number" name="pasajeros" id="pasajeros" class="form-control"
                    placeholder="Ej: 5"
                    value="{{ old('pasajeros') }}">
            </div>
            <div class="col-md-6">
                <label for="ruedas" class="form-label">Ruedas</label>
                <input type="number" name="ruedas" id="ruedas" class="form-control"
                    placeholder="Ej: 4"
                    value="{{ old('ruedas') }}">
            </div>
            <div class="col-md-6">
                <label for="ejes" class="form-label">Ejes</label>
                <input type="number" name="ejes" id="ejes" class="form-control"
                    placeholder="Ej: 2"
                    value="{{ old('ejes') }}">
            </div>
            <div class="col-md-6">
                <label for="cilindros" class="form-label">Cilindros</label>
                <input type="number" name="cilindros" id="cilindros" class="form-control"
                    placeholder="Ej: 6"
                    value="{{ old('cilindros') }}">
            </div>
            <div class="col-md-6">
                <label for="longitud" class="form-label">Longitud (m)</label>
                <input type="number" step="0.01" name="longitud" id="longitud" class="form-control"
                    placeholder="Ej: 4.50"
                    value="{{ old('longitud') }}">
            </div>
            <div class="col-md-6">
                <label for="altura" class="form-label">Altura (m)</label>
                <input type="number" step="0.01" name="altura" id="altura" class="form-control"
                    placeholder="Ej: 1.80"
                    value="{{ old('altura')}}">
            </div>
            <div class="col-md-6">
                <label for="ancho" class="form-label">Ancho (m)</label>
                <input type="number" step="0.01" name="ancho" id="ancho" class="form-control"
                    placeholder="Ej: 1.70"
                    value="{{ old('ancho') }}">
            </div>
            <div class="col-md-6">
                <label for="cilindrada" class="form-label">Cilindrada (L)</label>
                <input type="number" step="0.001" name="cilindrada" id="cilindrada" class="form-control"
                    placeholder="Ej: 2.000"
                    value="{{ old('cilindrada') }}">
            </div>
            <div class="col-md-6">
                <label for="pesoBruto" class="form-label">Peso Bruto (kg)</label>
                <input type="number" step="0.001" name="pesoBruto" id="pesoBruto" class="form-control"
                    placeholder="Ej: 3000"
                    value="{{ old('pesoBruto') }}">
            </div>
            <div class="col-md-6">
                <label for="pesoNeto" class="form-label">Peso Neto (kg)</label>
                <input type="number" step="0.001" name="pesoNeto" id="pesoNeto" class="form-control"
                    placeholder="Ej: 1500"
                    value="{{ old('pesoNeto') }}">
            </div>
            <div class="col-md-6">
                <label for="cargaUtil" class="form-label">Carga Útil (kg)</label>
                <input type="number" step="0.001" name="cargaUtil" id="cargaUtil" class="form-control"
                    placeholder="Ej: 1200"
                    value="{{ old('cargaUtil') }}">
            </div>
        </div>
        {{--  Botones
        <div class="mt-4 d-flex justify-content-end gap-2">
            <a href="{{ url('caracteristicas') }}" class="btn btn-outline-secondary">
                🔙 Cancelar
            </a>
            <button type="submit" class="btn btn-success">
                💾 Guardar
            </button>
        </div>  --}}
    </div>
</div>
@endif


{{-- Conductor --}}
@if($Modo == 'crearConductor' || $Modo == 'editarConductor')
<div class="card shadow mb-4 border-0">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">{{ $Modo == 'crearConductor' ? '➕ Agregar Conductor' : '✏️ Modificar Conductor' }}</h4>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label"> Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                    value="{{ old('nombre',isset($conductor->nombre) ? $conductor->nombre : '') }}">
            </div>
            <div class="col-md-6">
                <label for="licencia" class="form-label"> Licencia</label>
                <input type="text" name="licencia" id="licencia" class="form-control"
                    value="{{ old('licencia', isset($conductor->licencia) ? $conductor->licencia : '') }}">
            </div>
            <div class="col-md-6">
                <label for="telefono" class="form-label"> Telefono</label>
                <input type="text" name="telefono" id="telefono" class="form-control"
                    value="{{ old('telefono',isset($conductor->telefono) ? $conductor->telefono : '') }}">
            </div>
            <div class="col-md-6">
                <label for="categoriaLicencia" class="form-label"> Categoria de la Licencia</label>
                <input type="text" name="categoriaLicencia" id="categoriaLicencia" class="form-control"
                    value="{{ old('categoriaLicencia', isset($conductor->categoriaLicencia) ? $conductor->categoriaLicencia : '') }}">
            </div>
            <div class="col-md-6">
                <label for="area" class="form-label"> Area </label>
                <input type="text" name="area" id="area" class="form-control"
                    value="{{ old('area', isset($conductor->area) ? $conductor->area : '') }}">
            </div>
        </div>
    </div>
</div>
@endif

{{-- Vehiculo --}}
@if($Modo == 'crearV' || $Modo == 'editarV')
<div class="card shadow mb-4 border-0">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">{{ $Modo == 'crearV' ? '➕ Agregar Vehiculo' : '✏️ Modificar Vehiculo' }}</h4>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="categoria" class="form-label"> Categoria</label>
                <input type="text" name="categoria" id="categoria" class="form-control"
                    value="{{ isset($vehiculo->categoria) ? $vehiculo->categoria : '' }}">
            </div>
            <div class="col-md-6">
                <label for="marca" class="form-label"> Marca</label>
                <input type="text" name="marca" id="marca" class="form-control"
                    value="{{ isset($vehiculo->marca) ? $vehiculo->marca : '' }}">
            </div>
            <div class="col-md-6">
                <label for="modelo" class="form-label"> Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control"
                    value="{{ isset($vehiculo->modelo) ? $vehiculo->modelo : '' }}">
            </div>
            <div class="col-md-6">
                <label for="color" class="form-label"> Color</label>
                <input type="text" name="color" id="color" class="form-control"
                    value="{{ isset($vehiculo->color) ? $vehiculo->color : '' }}">
            </div>
            <div class="col-md-6">
                <label for="numeroVin" class="form-label"> Número Vin</label>
                <input type="text" name="numeroVin" id="numeroVin" class="form-control"
                    value="{{ isset($vehiculo->numeroVin) ? $vehiculo->numeroVin : '' }}">
            </div>
            <div class="col-md-6">
                <label for="numeroMotor" class="form-label"> Número Motor</label>
                <input type="text" name="numeroMotor" id="numeroMotor" class="form-control"
                    value="{{ isset($vehiculo->numeroMotor) ? $vehiculo->numeroMotor : '' }}">
            </div>
            <div class="col-md-6">
                <label for="carroceria" class="form-label"> Carroceria</label>
                <input type="text" name="carroceria" id="carroceria" class="form-control"
                    value="{{ isset($vehiculo->carroceria) ? $vehiculo->carroceria : '' }}">
            </div>
            <div class="col-md-6">
                <label for="potencia" class="form-label"> Potencia</label>
                <input type="text" name="potencia" id="potencia" class="form-control"
                    value="{{ isset($vehiculo->potencia) ? $vehiculo->potencia : '' }}">
            </div>
            <div class="col-md-6">
                <label for="formrod" class="form-label"> Form. Rod.</label>
                <input type="text" name="formrod" id="formrod" class="form-control"
                    value="{{ isset($vehiculo->formrod) ? $vehiculo->formrod : '' }}">
            </div>
            <div class="col-md-6">
                <label for="combustible" class="form-label"> Combustible</label>
                <input type="text" name="combustible" id="combustible" class="form-control"
                    value="{{ isset($vehiculo->combustible) ? $vehiculo->combustible : '' }}">
            </div>
            <div class="col-md-6">
                <label for="añoFabricacion" class="form-label"> Año Fabricacion</label>
                <input type="date" name="añoFabricacion" id="añoFabricacion" class="form-control"
                    value="{{ isset($vehiculo->añoFabricacion) ? $vehiculo->añoFabricacion : '' }}">
            </div>
            <div class="col-md-6">
                <label for="añoModelo" class="form-label"> Año Modelo</label>
                <input type="date" name="añoModelo" id="añoModelo" class="form-control"
                    value="{{ isset($vehiculo->añoModelo) ? $vehiculo->añoModelo : '' }}">
            </div>
            <div class="col-md-6">
                <label for="version" class="form-label"> Version</label>
                <input type="text" name="version" id="version" class="form-control"
                    value="{{ isset($vehiculo->version) ? $vehiculo->version : '' }}">
            </div>
            <div class="col-md-6">
                <label for="placaActual" class="form-label"> Placa Actual</label>
                <input type="text" name="placaActual" id="placaActual" class="form-control"
                    value="{{ isset($vehiculo->placaActual) ? $vehiculo->placaActual : '' }}">
            </div>
            <div class="col-md-6">
                <label for="placaAnterior" class="form-label"> Placa Anterior</label>
                <input type="text" name="placaAnterior" id="placaAnterior" class="form-control"
                    value="{{ isset($vehiculo->placaAnterior) ? $vehiculo->placaAnterior : '' }}">
            </div>
            <div class="col-md-6">
                <label for="condicion" class="form-label"> Condición</label>
                <input type="text" name="condicion" id="condicion" class="form-control"
                    value="{{ isset($vehiculo->condicion) ? $vehiculo->condicion : '' }}">
            </div>
            <div class="col-md-6">
                <label for="Estado" class="form-label">Estado</label>
                <input readonly type="text" name="Estado" id="Estado" class="form-control" 
                    value="{{ $vehiculo->Estado ?? 'activo' }}">
            </div>
            <div class="col-md-6">
                <label for="mpcscaracteristica_id" class="form-label"> Característica</label>
                <select name="mpcscaracteristica_id" id="mpcscaracteristica_id" class="form-select">
                    @foreach($caracteristica as $caracteristicas)
                        <option value="{{ $caracteristicas->id }}" {{ isset($vehiculo->mpcscaracteristica_id) && $vehiculo->mpcscaracteristica_id == $caracteristicas->id ? 'selected' : '' }}>
                            {{ $caracteristicas->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="mpcsconductor_id" class="form-label">🚚 Conductor</label>
                <select name="mpcsconductor_id" id="mpcsconductor_id" class="form-select">
                    @foreach($conductor as $conductores)
                        <option value="{{ $conductores->id }}" {{ isset($vehiculo->mpcsconductor_id) && $vehiculo->mpcsconductor_id == $conductores->id ? 'selected' : '' }}>
                            {{ $conductores->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Control --}}
@if($Modo == 'crearControl' || $Modo == 'editarControl')
<div class="card shadow mb-4 border-0">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            {{ $Modo == 'crearControl' ? '➕ Agregar Revisión' : '✏️ Modificar Revisión' }}
        </h4>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="soatInicial" class="form-label">Fecha de Soat</label>
                <input type="date" name="soatInicial" id="soatInicial" class="form-control"
                    value="{{ old('soatInicial', $control->soatInicial ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="soatFinal" class="form-label">Fecha de Vencimiento del Soat</label>
                <input type="date" name="soatFinal" id="soatFinal" class="form-control"
                    value="{{ old('soatFinal', $control->soatFinal ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="revisionTecIn" class="form-label">Fecha de la Revisión Técnica</label>
                <input type="date" name="revisionTecIn" id="revisionTecIn" class="form-control"
                    value="{{ old('revisionTecIn', $control->revisionTecIn ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="revisionTecFin" class="form-label">Fecha de Vencimiento de la Revisión Técnica</label>
                <input type="date" name="revisionTecFin" id="revisionTecFin" class="form-control"
                    value="{{ old('revisionTecFin', $control->revisionTecFin ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="tarjetaP" class="form-label">Tarjeta de Producto</label>
                <input type="text" name="tarjetaP" id="tarjetaP" class="form-control"
                    value="{{ old('tarjetaP', $control->tarjetaP ?? '') }}">
            </div>
            <div class="col-md-6">
                <label for="lugarD" class="form-label">Lugar de Destino</label>
                <input type="text" name="lugarD" id="lugarD" class="form-control"
                    value="{{ old('lugarD', $control->lugarD ?? '') }}">
            </div>  
            <div class="col-md-6">
                <label for="mpcsvehiculo_id" class="form-label"> Vehiculo</label>
                <select name="mpcsvehiculo_id" id="mpcsvehiculo_id" class="form-select">
                    @foreach($vehiculos as $vehic)
                        <option value="{{ $vehic->id }}" {{ isset($control->mpcsvehiculo_id) && $control->mpcsvehiculo_id == $vehic->id ? 'selected' : '' }}>
                            {{ $vehic->placaActual }}
                        </option>
                    @endforeach
                </select>
            </div>  
        </div>
    </div>
</div>
@endif

