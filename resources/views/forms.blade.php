{{-- Caracteristica --}}
@if($Modo == 'crearCarac' || $Modo == 'editarCarac')
<div class="card shadow mb-4 border-0">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">{{ $Modo == 'crearCarac' ? '➕ Agregar Caracteristicas' : '✏️ Modificar Caracteristicas' }}</h4>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="asientos" class="form-label"> N° Asientos</label>
                <input type="number" name="asientos" id="asientos" class="form-control"
                    value="{{ isset($caracteristica->asientos) ? $caracteristica->asientos : '' }}">
            </div>
            <div class="col-md-6">
                <label for="pasajeros" class="form-label"> Pasajeros</label>
                <input type="number" name="pasajeros" id="pasajeros" class="form-control"
                    value="{{ isset($caracteristica->pasajeros) ? $caracteristica->pasajeros : '' }}">
            </div>
            <div class="col-md-6">
                <label for="ruedas" class="form-label"> Ruedas</label>
                <input type="number" name="ruedas" id="ruedas" class="form-control"
                    value="{{ isset($caracteristica->ruedas) ? $caracteristica->ruedas : '' }}">
            </div>
            <div class="col-md-6">
                <label for="ejes" class="form-label"> Ejes</label>
                <input type="number" name="ejes" id="ejes" class="form-control"
                    value="{{ isset($caracteristica->ejes) ? $caracteristica->ejes : '' }}">
            </div>
            <div class="col-md-6">
                <label for="cilindros" class="form-label"> Cilindros</label>
                <input type="number" name="cilindros" id="cilindros" class="form-control"
                    value="{{ isset($caracteristica->cilindros) ? $caracteristica->cilindros : '' }}">
            </div>
            <div class="col-md-6">
                <label for="longitud" class="form-label"> Longitud</label>
                <input type="number" step="0.01" name="longitud" id="longitud" class="form-control"
                    value="{{ isset($caracteristica->longitud) ? $caracteristica->longitud : '' }}">
            </div>
            <div class="col-md-6">
                <label for="altura" class="form-label"> Altura</label>
                <input type="number" step="0.01" name="altura" id="altura" class="form-control"
                    value="{{ isset($caracteristica->altura) ? $caracteristica->altura : '' }}">
            </div>
            <div class="col-md-6">
                <label for="ancho" class="form-label"> Ancho</label>
                <input type="text" step="0.01" name="ancho" id="ancho" class="form-control"
                    value="{{ isset($caracteristica->ancho) ? $caracteristica->ancho : '' }}">
            </div>
            <div class="col-md-6">
                <label for="cilindrada" class="form-label"> Cilindrada</label>
                <input type="text" step="0.01" name="cilindrada" id="cilindrada" class="form-control"
                    value="{{ isset($caracteristica->cilindrada) ? $caracteristica->cilindrada : '' }}">
            </div>
            <div class="col-md-6">
                <label for="pesoBruto" class="form-label"> Peso Bruto</label>
                <input type="text" step="0.01" name="pesoBruto" id="pesoBruto" class="form-control"
                    value="{{ isset($caracteristica->pesoBruto) ? $caracteristica->pesoBruto : '' }}">
            </div>
            <div class="col-md-6">
                <label for="pesoNeto" class="form-label"> Peso Neto</label>
                <input type="text" step="0.01" name="pesoNeto" id="pesoNeto" class="form-control"
                    value="{{ isset($caracteristica->pesoNeto) ? $caracteristica->pesoNeto : '' }}">
            </div>
            <div class="col-md-6">
                <label for="cargaUtil" class="form-label"> Carga Util</label>
                <input type="text" step="0.01" name="cargaUtil" id="cargaUtil" class="form-control"
                    value="{{ isset($caracteristica->cargaUtil) ? $caracteristica->cargaUtil : '' }}">
            </div>
        </div>
    </div>
</div>
@endif