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
        Schema::create('mpcscontrols', function (Blueprint $table) {
            $table->id();
            $table->date('soatInicial');
            $table->date('soatFinal');
            $table->date('revisionTecIn');
            $table->date('revisionTecFin');
            $table->string('tarjetaP');
            $table->string('lugarD');
            $table->text('imagenSoat');
            $table->foreignId('mpcsvehiculo_id')->constrained('mpcsvehiculos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mpcscontrols');
    }
};
