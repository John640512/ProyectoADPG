<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre', 200);
            $table->text('descripcion', 300);
            $table->datetime('fecha_registro');

            $table->foreignId('id_tipo_producto')
                  ->nullable() 
                  ->constrained('tipo_producto', 'id_tipo_producto')
                  ->nullOnDelete();

            $table->foreignId('id_proveedor')
                  ->nullable()
                  ->constrained('proveedor', 'id_proveedor')
                  ->nullOnDelete(); 

            $table->foreignId('id_ubicacion')
                  ->nullable() 
                  ->constrained('ubicacion', 'id_ubicacion')
                  ->nullOnDelete(); 
        }); 
    }

   
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
