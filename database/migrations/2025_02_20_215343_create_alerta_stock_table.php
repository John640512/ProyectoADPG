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
        Schema::create('alerta_stock', function (Blueprint $table) {
            $table->id('id_alerta');
            $table->decimal('nivel_minimo', 7,2);
            $table->char('notificacion', 1);
            $table->foreignId('id_stock')->constrained('stock', 'id_stock')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerta_stock');
    }
};
