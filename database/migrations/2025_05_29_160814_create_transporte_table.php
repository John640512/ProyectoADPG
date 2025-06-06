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
        Schema::create('transporte', function (Blueprint $table) {
            $table->id('id_transporte');
            $table->dateTime('fecha_salida');
            $table->string('color', 200);
            $table->decimal('cantidad_toneladas', 7,2);
            $table->string('modelo', 200);
            $table->foreignId('id_tipo_transporte')->constrained('tipo_transporte', 'id_tipo_transporte')->unsigned();
            $table->foreignId('id_trabajador')->nullable()->constrained('trabajador', 'id_trabajador')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transporte');
    }
};
