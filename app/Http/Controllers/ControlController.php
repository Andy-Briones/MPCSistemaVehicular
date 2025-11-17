<?php

namespace App\Http\Controllers;

use App\Models\mpcscontrol;
use App\Models\mpcsvehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use PhpOffice\PhpWord\Shared\Html;
use PhpParser\Builder\TraitUse; 


class ControlController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = MpcsControl::with(['vehiculo.conductor']);

        //Busqueda por placa
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('vehiculo', function($q) use ($search) {
                $q->where('placaActual', 'like', "%{$search}%");
            });
        }

        //Filtro para vencimientos
        if ($request->filled('filtro_venc')) {
        $filtro = $request->input('filtro_venc');

        if ($filtro === 'soat') {
            $query->orderBy('soatFinal', 'asc');  
        } elseif ($filtro === 'revision') {
            $query->orderBy('revisionTecFin', 'asc');
        }
    }

        $mpcscontrols = $query->paginate(10);

        //Alertas
        $alerta = [];
        foreach($mpcscontrols as $control)
        {
            $hoy = Carbon::now();

            //Alerta de 10 dias con antelacion
            $avisoSoat = (int)$hoy->diffInDays(Carbon::parse($control->soatFinal), false);
            $avisoRevision = (int)$hoy->diffInDays(Carbon::parse($control->revisionTecFin), false);

            //Revisamos si faln 10 días
            if($avisoSoat <= 10 && $avisoSoat >= 0)
            {
                $alerta[]=[
                    'tipo' => 'SOAT',
                    'vehiculo' => $control->vehiculo->placaActual ?? 'Desconocido',
                    'vence' => $control->soatFinal,
                    'dias' => $avisoSoat,
                ];
            }
            if($avisoRevision <= 10 && $avisoRevision >= 0)
            {
                $alerta[] = [
                    'tipo' => 'Revisión Técnica',
                    'vehiculo' => $control->vehiculo->placaActual ?? 'Desconocido',
                    'vence' => $control->revisionTecFin,
                    'dias' => $avisoRevision,
                ];
            }
        }

        return view('control.index', compact('mpcscontrols', 'alerta'));
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
        // Guardar imagen
        $data = $request->except('_token');

        // GUARDAR IMAGEN COMO BASE64 EN LA BD
        if ($request->hasFile('imagenSoat')) {
            $file = $request->file('imagenSoat');

            // nombre único
            $filename = time() . '_' . $file->getClientOriginalName();

            // mover a public/imagenes
            $file->move(public_path('Imgs'), $filename);

            // guardar en la BD solo la ruta o el nombre
            $data['imagenSoat'] = 'Imgs/' . $filename;
        }


        mpcscontrol::create($data);

        return redirect('/controles')->with('mensaje', 'Control agregado con éxito');
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
        $control = mpcscontrol::findOrFail($id);

        $data = $request->except(['_token', '_method']);

        // Si suben una nueva imagen
        if ($request->hasFile('imagenSoat')) {

            // ================================
            // 1. ELIMINAR IMAGEN ANTERIOR
            // ================================
            if ($control->imagenSoat && file_exists(public_path($control->imagenSoat))) {
                unlink(public_path($control->imagenSoat));
            }

            // ================================
            // 2. GUARDAR LA NUEVA IMAGEN
            // ================================
            $file = $request->file('imagenSoat');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Guardar en public/Imgs
            $file->move(public_path('Imgs'), $filename);

            // Guardar ruta en BD
            $data['imagenSoat'] = 'Imgs/' . $filename;
        }

        // Actualizar todo
        $control->update($data);

        return redirect()->route('controles.index')->with('mensaje', 'Control actualizado');
    }
    public function destroy($id)
    {
        
    }
    // public function descargarWord($id)
    // {
    //     // Carga completa del control con su vehículo y relaciones
    //     $control = MpcsControl::with(['vehiculo.conductor', 'vehiculo.caracteristica'])->findOrFail($id);
    //     $vehiculo = $control->vehiculo;
    //     $caract = $vehiculo->caracteristica;
    //     $conductor = $vehiculo->conductor;

    //     // Crear documento Word
    //     $phpWord = new PhpWord();
    //     $section = $phpWord->addSection([
    //         'marginLeft' => 800,
    //         'marginRight' => 800,
    //         'marginTop' => 600,
    //         'marginBottom' => 600,
    //     ]);

    //     // ===== ENCABEZADO =====
    //     $center = ['alignment' => 'center'];
    //     $section->addText("REPÚBLICA DEL PERÚ", ['bold' => true, 'size' => 12], $center);
    //     $section->addText("SUPERINTENDENCIA NACIONAL DE LOS REGISTROS PÚBLICOS", ['bold' => true, 'size' => 10], $center);
    //     $section->addText("TARJETA DE IDENTIFICACIÓN VEHICULAR ELECTRÓNICA", ['bold' => true, 'size' => 12], $center);
    //     $section->addText("ZONA REGISTRAL N° II - CAJAMARCA", ['size' => 10], $center);

    //     $section->addTextBreak(1);

    //     // ===== DATOS PRINCIPALES =====
    //     $section->addText("Condición: " . ($vehiculo->condicion ?? '-'));
    //     $section->addText("Placa Actual: " . ($vehiculo->placaActual ?? '-'), ['bold' => true, 'size' => 12]);
    //     $section->addText("Placa Anterior: " . ($vehiculo->placaAnterior ?? '-'));
    //     $section->addTextBreak(1);

    //     // ===== DATOS DEL VEHÍCULO =====
    //     $section->addText("Datos del Vehículo", ['bold' => true, 'underline' => 'single']);
    //     $section->addTextBreak(0.5);

    //     // Tabla 1 (categoría / año fabric.)
    //     $table1 = $section->addTable();
    //     $table1->addRow();
    //     $table1->addCell(4500)->addText("Categoría: " . ($vehiculo->categoria ?? '-'));
    //     $table1->addCell(4500)->addText("Año Fabric.: " . ($vehiculo->añoFabricacion ?? '-'));

    //     $table1->addRow();
    //     $table1->addCell(4500)->addText("Marca: " . ($vehiculo->marca ?? '-'));
    //     $table1->addCell(4500)->addText("Año Modelo: " . ($vehiculo->añoModelo ?? '-'));

    //     $table1->addRow();
    //     $table1->addCell(4500)->addText("Modelo: " . ($vehiculo->modelo ?? '-'));
    //     $table1->addCell(4500)->addText("Color: " . ($vehiculo->color ?? '-'));

    //     $table1->addRow();
    //     $table1->addCell(4500)->addText("Número VIN: " . ($vehiculo->numeroVin ?? '-'));
    //     $table1->addCell(4500)->addText("Número de Serie: " . ($vehiculo->numeroVin ?? '-')); // mismo campo del ejemplo

    //     $table1->addRow();
    //     $table1->addCell(4500)->addText("Número Motor: " . ($vehiculo->numeroMotor ?? '-'));
    //     $table1->addCell(4500)->addText("Carrocería: " . ($vehiculo->carroceria ?? '-'));

    //     $table1->addRow();
    //     $table1->addCell(4500)->addText("Potencia: " . ($vehiculo->potencia ?? '-'));
    //     $table1->addCell(4500)->addText(""); // vacío igual que ejemplo

    //     $table1->addRow();
    //     $table1->addCell(4500)->addText("Form. Rod: " . ($vehiculo->formrod ?? '-'));
    //     $table1->addCell(4500)->addText("Versión: " . ($vehiculo->version ?? '-'));

    //     $table1->addRow();
    //     $table1->addCell(4500)->addText("Combustible: " . ($vehiculo->combustible ?? '-'));
    //     $table1->addCell(4500)->addText(""); // relleno

    //     $section->addTextBreak(1);

    //     // ===== CARACTERÍSTICAS TÉCNICAS =====
    //     $section->addText("Características Técnicas", ['bold' => true, 'underline' => 'single']);
    //     $section->addTextBreak(0.5);

    //     $table2 = $section->addTable();

    //     $carRows = [
    //         ['Asientos', $caract->asientos],
    //         ['Pasajeros', $caract->pasajeros],
    //         ['Ruedas', $caract->ruedas],
    //         ['Ejes', $caract->ejes],
    //         ['Cilindros', $caract->cilindros],
    //         ['Longitud', $caract->longitud],
    //         ['Altura', $caract->altura],
    //         ['Ancho', $caract->ancho],
    //         ['Cilindrada', $caract->cilindrada],
    //         ['P. Bruto', $caract->pesoBruto],
    //         ['P. Neto', $caract->pesoNeto],
    //         ['Carga Útil', $caract->cargaUtil],
    //     ];

    //     foreach ($carRows as [$label, $value]) {
    //         $table2->addRow();
    //         $table2->addCell(4500)->addText("$label: " . ($value ?? '-'));
    //     }

    //     $section->addTextBreak(2);

    //     // ===== CONDUCTOR =====
    //     $section->addText("Conductor: " . ($conductor->nombre ?? '-') . " " . ($conductor->apellido ?? '-'), ['bold' => true]);
    //     $section->addText("Lugar de destino: " . ($control->lugarD ?? '-'));

    //     $section->addTextBreak(2);
    //     $section->addText("Registrador Público: ____________________________", ['size' => 10]);
    //     $section->addText("Zona Registral: _________________________________", ['size' => 10]);

    //     // ===== DESCARGA =====
    //     $fileName = 'Tarjeta_Vehicular_' . $vehiculo->placaActual . '.docx';
    //     $tempFile = tempnam(sys_get_temp_dir(), 'vehiculo');
    //     $writer = IOFactory::createWriter($phpWord, 'Word2007');
    //     $writer->save($tempFile);

    //     return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    // }

    public function descargarWord($id)
{
    // Cargar control con vehículo, conductor y características
    $control = MpcsControl::with(['vehiculo.conductor', 'vehiculo.caracteristica'])->findOrFail($id);
    $vehiculo = $control->vehiculo;
    $caract = $vehiculo->caracteristica;
    $conductor = $vehiculo->conductor;

    // Crear documento Word
    $phpWord = new PhpWord();
    $section = $phpWord->addSection([
        'marginLeft' => 800,
        'marginRight' => 800,
        'marginTop' => 600,
        'marginBottom' => 600,
    ]);

    // ===== ENCABEZADO =====
    $center = ['alignment' => 'center'];
    $section->addText("REPÚBLICA DEL PERÚ", ['bold' => true, 'size' => 12], $center);
    $section->addText("SUPERINTENDENCIA NACIONAL DE LOS REGISTROS PÚBLICOS", ['bold' => true, 'size' => 10], $center);
    $section->addText("TARJETA DE IDENTIFICACIÓN VEHICULAR ELECTRÓNICA", ['bold' => true, 'size' => 12], $center);
    $section->addText("ZONA REGISTRAL N° II - CAJAMARCA", ['size' => 10], $center);

    $section->addTextBreak(1);

    // ===== DATOS PRINCIPALES =====
    $section->addText("Condición: " . ($vehiculo->condicion ?? '-'));
    $section->addText("Placa Actual: " . ($vehiculo->placaActual ?? '-'), ['bold' => true, 'size' => 12]);
    $section->addText("Placa Anterior: " . ($vehiculo->placaAnterior ?? '-'));
    $section->addTextBreak(1);

    // ===== DATOS DEL VEHÍCULO =====
    $section->addText("Datos del Vehículo", ['bold' => true, 'underline' => 'single']);
    $section->addTextBreak(0.5);

    // --- Tabla de 2 columnas ---
    $tableVehiculo = $section->addTable(['borderSize' => 6, 'cellMargin' => 80]);
    $tableVehiculo->addRow();
    $tableVehiculo->addCell(4500)->addText("Categoría: " . ($vehiculo->categoria ?? '-'));
    $tableVehiculo->addCell(4500)->addText("Año Fabricación: " . ($vehiculo->añoFabricacion ?? '-'));

    $tableVehiculo->addRow();
    $tableVehiculo->addCell(4500)->addText("Marca: " . ($vehiculo->marca ?? '-'));
    $tableVehiculo->addCell(4500)->addText("Año Modelo: " . ($vehiculo->añoModelo ?? '-'));

    $tableVehiculo->addRow();
    $tableVehiculo->addCell(4500)->addText("Modelo: " . ($vehiculo->modelo ?? '-'));
    $tableVehiculo->addCell(4500)->addText("Color: " . ($vehiculo->color ?? '-'));

    $tableVehiculo->addRow();
    $tableVehiculo->addCell(4500)->addText("Número VIN: " . ($vehiculo->numeroVin ?? '-'));
    $tableVehiculo->addCell(4500)->addText("Número de Serie: " . ($vehiculo->numeroSerie ?? '-'));

    $tableVehiculo->addRow();
    $tableVehiculo->addCell(4500)->addText("Número Motor: " . ($vehiculo->numeroMotor ?? '-'));
    $tableVehiculo->addCell(4500)->addText("Carrocería: " . ($vehiculo->carroceria ?? '-'));

    $tableVehiculo->addRow();
    $tableVehiculo->addCell(4500)->addText("Potencia: " . ($vehiculo->potencia ?? '-'));
    $tableVehiculo->addCell(4500)->addText("Versión: " . ($vehiculo->version ?? '-'));

    $tableVehiculo->addRow();
    $tableVehiculo->addCell(4500)->addText("Form. Rod: " . ($vehiculo->formrod ?? '-'));
    $tableVehiculo->addCell(4500)->addText("Combustible: " . ($vehiculo->combustible ?? '-'));

    $section->addTextBreak(1);

    // ===== CARACTERÍSTICAS TÉCNICAS =====
    $section->addText("Características Técnicas", ['bold' => true, 'underline' => 'single']);
    $section->addTextBreak(0.5);

    // --- Tabla de 3 columnas ---
    $tableCaract = $section->addTable(['borderSize' => 6, 'cellMargin' => 80]);

    $carRows = [
        ['Asientos', $caract->asientos, 'Pasajeros', $caract->pasajeros, 'Ruedas', $caract->ruedas],
        ['Ejes', $caract->ejes, 'Cilindros', $caract->cilindros, 'Cilindrada', $caract->cilindrada],
        ['Longitud', $caract->longitud, 'Altura', $caract->altura, 'Ancho', $caract->ancho],
        ['P. Bruto', $caract->pesoBruto, 'P. Neto', $caract->pesoNeto, 'Carga Útil', $caract->cargaUtil],
    ];

    foreach ($carRows as $row) {
        $tableCaract->addRow();
        for ($i = 0; $i < count($row); $i += 2) {
            $label = $row[$i];
            $value = $row[$i + 1] ?? '-';
            $tableCaract->addCell(3000)->addText("$label: " . ($value ?? '-'));
        }
    }

    // ===== CONDUCTOR =====
    $section->addText("Conductor: " . ($conductor->nombre ?? '-') . " " . ($conductor->apellido ?? '-'), ['bold' => true]);
    $section->addText("Lugar de destino: " . ($control->lugarD ?? '-'),['bold' => true] );

    // ======== GENERAR QR ========
    $writerQr = new PngWriter();

    // Contenido del QR (puede ser cualquier texto, URL o placa)
    $qrContent = "Placa: " . ($vehiculo->placaActual ?? '-') . "\n" .
                 "Conductor: " . ($conductor->nombre ?? '-') . " " . ($conductor->apellido ?? '-');

    $qrCode = new QrCode($qrContent);
    $qrCode->setSize(120); // tamaño en píxeles

    // Generar la imagen temporal del QR
    $qrResult = $writerQr->write($qrCode);
    $qrTempPath = tempnam(sys_get_temp_dir(), 'qr_') . '.png';
    $qrResult->saveToFile($qrTempPath);

    // Insertar el QR en el documento (por ejemplo al final)
    $section->addTextBreak(1);
    $section->addText("Código QR de Verificación:", ['bold' => true]);
    $section->addImage($qrTempPath, [
        'width' => 80,
        'height' => 80,
        'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
    ]);

    // ===== DESCARGA =====
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
