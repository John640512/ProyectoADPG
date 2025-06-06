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
        Schema::create('trabajador', function (Blueprint $table) {
            $table->id('id_trabajador');
            $table->string('nombre', 200);
            $table->string('apellido_paterno', 200);
            $table->string('apellido_materno', 200);
            $table->bigInteger('telefono');
            $table->string('correo_electronico', 200)->nullable(true);
            $table->string('estado', 200);
            $table->string('calle', 200);
            $table->string('colonia', 200);
            $table->string('entre_calles', 200);
            $table->char('cp', 13);
            $table->string('numero_externo', 10);
            $table->string('numero_interno', 10)->nullable(true);
            $table->string('ciudad', 200)->nullable();  // Nuevo
            $table->string('municipio', 200)->nullable(); // Nuevo
            $table->string('rfc', 50)->nullable(); // Nuevo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajador');
    }
};
