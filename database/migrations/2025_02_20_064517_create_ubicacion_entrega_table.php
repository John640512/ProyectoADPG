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
        Schema::create('ubicacion_entrega', function (Blueprint $table) {
            $table->id('id_ubicacion_entrega');
            $table->string('nombre_negocio', 200);
            $table->string('estado', 200);
            $table->string('calle', 200);
            $table->string('colonia', 200);
            $table->string('entre_calles', 200);
            $table->text('descripcion_lugar', 350);
            $table->char('cp', 13);
            $table->string('numero_externo', 10);
            $table->string('numero_interno', 10)->nullable(true);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacion_entrega');
    }
};
