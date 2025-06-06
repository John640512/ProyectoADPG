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
        Schema::create('transporte_ubicacion_entrega', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_transporte')->constrained('transporte', 'id_transporte')->unsigned();
            $table->foreignId('id_ubicacion_entrega')->constrained('ubicacion_entrega', 'id_ubicacion_entrega')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transporte_ubicacion_entrega');
    }
};
