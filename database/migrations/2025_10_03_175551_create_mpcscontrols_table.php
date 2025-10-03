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
            $table->string('soatInicial');
            $table->string('soatFinal');
            $table->string('revisionTecIn');
            $table->string('revisionTecFin');
            $table->string('tarjetaP');
            $table->string('lugarD');
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
