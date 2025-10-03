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
        Schema::create('mpcsconductors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('licencia');
            $table->string('telefono');
            $table->string('categoriaLicencia');
            $table->string('area');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mpcsconductors');
    }
};
