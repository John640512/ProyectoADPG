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
        Schema::create('ubicacion_proveedor', function (Blueprint $table) {
            $table->id('id_ub_proveedor');
            $table->string('estado', 200)->nullable(true);
            $table->string('ciudad', 200)->nullable(true); 
            $table->string('municipio', 200)->nullable(true); 
            $table->string('calle', 200)->nullable(true);
            $table->string('colonia', 200)->nullable(true);
            $table->string('cp', 10)->nullable(true);
            $table->string('numero_externo', 10)->nullable(true);
            $table->string('numero_interno', 10)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacion_proveedor');
    }
};
