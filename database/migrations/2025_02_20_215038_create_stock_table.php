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
        Schema::create('stock', function (Blueprint $table) {
            $table->id('id_stock');
            $table->dateTime('fecha_llegada');
            $table->decimal('cantidad_toneladas', 7,2);
            $table->char('metodo_pago', 1);
            $table->foreignId('id_producto')
            ->constrained('producto', 'id_producto')
            ->onDelete('restrict')
            ->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
