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
        Schema::create('transporte_producto', function (Blueprint $table) {
        $table->unsignedBigInteger('id_transporte');
        $table->unsignedBigInteger('id_producto');
        $table->primary(['id_transporte', 'id_producto']);
        
        $table->foreign('id_transporte')->references('id_transporte')->on('transporte')->onDelete('cascade');
        $table->foreign('id_producto')->references('id_producto')->on('producto')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transporte_producto');
    }
};
