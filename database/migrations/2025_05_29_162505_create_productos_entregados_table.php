<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosEntregadosTable extends Migration
{
    public function up()
    {
        Schema::create('productos_entregados', function (Blueprint $table) {
            $table->id('id_producto_entregado');
            
            $table->unsignedBigInteger('id_transporte');
            $table->date('fecha_entrega')->nullable();
            
            // No agregamos $table->timestamps();

            $table->foreign('id_transporte')->references('id_transporte')->on('transporte')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos_entregados');
    }
}
