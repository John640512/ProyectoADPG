<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nombre', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('estados');
    }
};