<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mpcsvehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');
            $table->string('codPatrimonial');
            $table->string('marca');
            $table->string('modelo');
            $table->string('color');
            $table->string('numeroVin');
            $table->string('numeroMotor');
            $table->string('carroceria');
            $table->string('potencia');
            $table->string('formrod');
            $table->string('combustible');
            $table->date('aniooFabricacion');
            $table->date('anioModelo');
            $table->string('version');
            $table->string('placaActual');
            $table->string('placaAnterior');
            $table->string('condicion');
            $table->string('Estado')->default('activo');
            $table->string('observaciones');
            $table->foreignId('mpcscaracteristica_id')->constrained('mpcscaracteristicas')->onDelete('cascade');
            $table->foreignId('mpcsconductor_id')->constrained('mpcsconductors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mpcsvehiculos');
    }
};
