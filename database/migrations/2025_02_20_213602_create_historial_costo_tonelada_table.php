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
        Schema::create('historial_costo_tonelada', function (Blueprint $table) {
            $table->id('id_historial');
            $table->dateTime('fecha_registro');
            $table->decimal('costo_anterior', 10,2);
            $table->decimal('costo_actual', 10,2);
            $table->text('razon_cambio', 300);
            $table->foreignId('id_producto')->nullable()->constrained('producto', 'id_producto')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_costo_tonelada');
    }
};
