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
        Schema::create('costo_por_tonelada', function (Blueprint $table) {
            $table->id('id_costo_por_tonelada');
            $table->decimal('costo_tonelada', 10, 2);
            $table->foreignId('id_tipo_producto')->nullable()->constrained('tipo_producto', 'id_tipo_producto')->nullOnDelete();
            $table->foreignId('id_proveedor')->nullable()->constrained('proveedor', 'id_proveedor')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costo_por_tonelada');
    }
};
