<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedor', function (Blueprint $table) {
          $table->bigIncrements('id_proveedor');
         $table->string('nombre', 200);
            $table->bigInteger('telefono')->nullable(true);
            $table->string('correo_electronico', 200)->nullable(true);
            $table->foreignId('id_ub_proveedor')
                ->constrained('ubicacion_proveedor', 'id_ub_proveedor')
                ->onDelete('cascade') 
                ->unsigned();
            $table->char('rfc', 13);
               });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('proveedor');
    }
};