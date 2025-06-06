
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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre', 200);
            $table->string('apellido_paterno', 200);
            $table->string('apellido_materno', 200);
            $table->bigInteger('telefono')->nullable(true);
            $table->string('password', 200);
            $table->string('correo_electronico', 200);
            $table->foreignId('id_rol')->constrained('rol', 'id_rol')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
