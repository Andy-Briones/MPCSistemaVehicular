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
        Schema::create('mpcscaracteristicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('asientos');
            $table->integer('pasajeros');
            $table->integer('ruedas');
            $table->integer('ejes');
            $table->integer('cilindros');
            $table->decimal('longitud', 10, 2);
            $table->decimal('altura', 10, 2);
            $table->decimal('ancho', 10, 2);
            $table->decimal('cilindrada', 10, 3);
            $table->decimal('pesoBruto', 10, 3);
            $table->decimal('pesoNeto', 10, 3);
            $table->decimal('cargaUtil', 10, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mpcscaracteristicas');
    }
};
