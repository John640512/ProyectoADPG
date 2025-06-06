<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->id('id_inventario');
            $table->date('fecha_corte_semanalmente')->nullable();
            $table->char('estado', 1);
            $table->string('nivel_actual_stock')->nullable();
            $table->decimal('nivel_minimo_stock', 8, 2)->nullable();

            $table->foreignId('id_producto')
                  ->constrained('producto', 'id_producto')
                  ->onDelete('cascade');

            $table->foreignId('id_stock')
                  ->constrained('stock', 'id_stock')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
