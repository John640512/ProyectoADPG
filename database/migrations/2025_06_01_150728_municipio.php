<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('id_estado');
            $table->string('municipio', 100);

            $table->foreign('id_estado')->references('id')->on('estados');
        });
    }

    public function down()
    {
        Schema::dropIfExists('municipios');
    }
};