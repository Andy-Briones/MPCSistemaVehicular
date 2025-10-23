<?php

namespace App\Http\Controllers;

use App\Models\mpcscontrol;
use App\Models\mpcsvehiculo;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class ControlController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = MpcsControl::with(['vehiculo.conductor']);

        if ($request->filled('search')) {
        $search = $request->input('search');
        $query->whereHas('vehiculo', function($q) use ($search) {
            $q->where('placaActual', 'like', "%{$search}%");
        });
    }

    $mpcscontrols = $query->paginate(10);

    return view('control.index', compact('mpcscontrols'));
    }
    public function create()
    {
        $vehiculos = mpcsvehiculo::all();   // todos los vehiculos

        return view('control.create', [
            'Modo' => 'crearControl',
            'vehiculos' => $vehiculos
        ]);
    }
    public function store(Request $request)
    {
        $control = request()->except('_token');
        mpcscontrol::insert($control);
        return redirect('/');//->with('mensaje', 'Vehiculo agregado con éxito');
    }
    public function show()
    {
        
    }
    public function edit($id)
    {
        $control = mpcscontrol::findOrFail($id);
        $vehiculos = mpcsvehiculo::all();   // vehiculos
        
        return view('control.edit', [
        'control' => $control,
        'vehiculos' => $vehiculos,
        'Modo' => 'editarControl'
        ]);
    }
    public function update(Request $request, $id)
    {
        $control = request()->except(['_token', '_method']);
        mpcscontrol::where('id', '=', $id)->update($control);
        return redirect()->route('control.index');
    }
    public function destroy($id)
    {
        
    }
    public function descargarWord($id)
    {
        // Buscar el control con su vehículo, conductor y características
        $control = MpcsControl::with(['vehiculo.conductor', 'vehiculo.caracteristica'])->findOrFail($id);
        $vehiculo = $control->vehiculo;
        $caract = $vehiculo->caracteristica;
        $conductor = $vehiculo->conductor;

        // Crear el documento Word
        $phpWord = new PhpWord();
        $section = $phpWord->addSection([
            'marginLeft' => 800,
            'marginRight' => 800,
            'marginTop' => 600,
            'marginBottom' => 600,
        ]);

        // ===== Encabezado =====
        $section->addText("REPÚBLICA DEL PERÚ", ['bold' => true, 'size' => 12], ['alignment' => 'center']);
        $section->addText("SUPERINTENDENCIA NACIONAL DE LOS REGISTROS PÚBLICOS", ['bold' => true, 'size' => 10], ['alignment' => 'center']);
        $section->addText("TARJETA DE IDENTIFICACIÓN VEHICULAR ELECTRÓNICA", ['bold' => true, 'size' => 12], ['alignment' => 'center']);
        $section->addText("ZONA REGISTRAL N° II - CAJAMARCA", ['size' => 10], ['alignment' => 'center']);

        $section->addTextBreak(1);

        // ===== Datos principales =====
        $section->addText("Condición: {$vehiculo->condicion}");
        $section->addText("Placa Actual: {$vehiculo->placaActual}", ['bold' => true, 'size' => 12]);
        $section->addText("Placa Anterior: {$vehiculo->placaAnterior}");
        $section->addTextBreak(1);

        // ===== Datos del vehículo =====
        $section->addText("Datos del Vehículo", ['bold' => true, 'underline' => 'single']);
        $section->addTextBreak(0.5);

        $data = [
            'Categoría' => $vehiculo->categoria,
            'Marca' => $vehiculo->marca,
            'Modelo' => $vehiculo->modelo,
            'Color' => $vehiculo->color,
            'Número de VIN' => $vehiculo->numeroVin,
            'Número de Motor' => $vehiculo->numeroMotor,
            'Carrocería' => $vehiculo->carroceria,
            'Potencia' => $vehiculo->potencia,
            'Forma Rodante' => $vehiculo->formrod,
            'Combustible' => $vehiculo->combustible,
            'Versión' => $vehiculo->version,
            'Año Fabricación' => $vehiculo->añoFabricacion,
            'Año Modelo' => $vehiculo->añoModelo,
        ];

        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80,
        ]);

        foreach ($data as $key => $value) {
            $table->addRow();
            $table->addCell(3000)->addText($key . ':', ['bold' => true]);
            $table->addCell(5000)->addText($value ?? '-');
        }

        $section->addTextBreak(1);

        // ===== Características técnicas =====
        $section->addText("Características Técnicas", ['bold' => true, 'underline' => 'single']);
        $section->addTextBreak(0.5);

        $carData = [
            'Asientos' => $caract->asientos,
            'Pasajeros' => $caract->pasajeros,
            'Ruedas' => $caract->ruedas,
            'Ejes' => $caract->ejes,
            'Cilindros' => $caract->cilindros,
            'Cilindrada' => $caract->cilindrada,
            'Longitud (m)' => $caract->longitud,
            'Altura (m)' => $caract->altura,
            'Ancho (m)' => $caract->ancho,
            'Peso Bruto (kg)' => $caract->pesoBruto,
            'Peso Neto (kg)' => $caract->pesoNeto,
            'Carga Útil (kg)' => $caract->cargaUtil,
        ];

        $table2 = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80,
        ]);

        foreach ($carData as $key => $value) {
            $table2->addRow();
            $table2->addCell(3000)->addText($key . ':', ['bold' => true]);
            $table2->addCell(5000)->addText($value ?? '-');
        }

        $section->addTextBreak(2);

        // ===== Conductor =====
        $section->addText("Conductor: " . ($conductor->nombre ?? '-') . " " . ($conductor->apellido ?? ''), ['bold' => true]);
        $section->addText("Lugar de destino: " . ($control->lugarD ?? '-'));

        $section->addTextBreak(2);
        $section->addText("Registrador Público: ____________________________", ['size' => 10]);
        $section->addText("Zona Registral: _________________________________", ['size' => 10]);

        // ===== Generar archivo =====
        $fileName = 'Tarjeta_Vehicular_' . $vehiculo->placaActual . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'vehiculo');
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
    // Vista previa del Word
    public function previewWord($id)
    {
        $vehiculo = MpcsVehiculo::with(['caracteristica', 'conductor'])->findOrFail($id);
        return view('control.preview', compact('vehiculo'));
    }

    // Descarga del Word
    public function downloadWord($id)
    {
        $vehiculo = MpcsVehiculo::with(['caracteristica', 'conductor'])->findOrFail($id);

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $section->addText('TARJETA DE IDENTIFICACIÓN VEHICULAR ELECTRÓNICA', ['bold' => true, 'size' => 14], ['alignment' => 'center']);
        $section->addTextBreak(1);

        $section->addText("Placa: " . $vehiculo->placaActual);
        $section->addText("Marca: " . $vehiculo->marca);
        $section->addText("Modelo: " . $vehiculo->modelo);
        $section->addText("Color: " . $vehiculo->color);
        $section->addText("Número de Motor: " . $vehiculo->numeroMotor);
        $section->addText("Número VIN: " . $vehiculo->numeroVin);
        $section->addText("Conductor: " . $vehiculo->conductor->nombre);
        $section->addText("Año de Fabricación: " . $vehiculo->añoFabricacion);

        $fileName = 'Tarjeta_' . $vehiculo->placaActual . '.docx';
        $filePath = storage_path('app/public/' . $fileName);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
