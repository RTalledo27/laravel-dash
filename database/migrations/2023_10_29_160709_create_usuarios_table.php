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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('usuario');
            $table->string('password');
            $table->string('nombre');
            $table->unsignedBigInteger('idCaja');
            $table->unsignedBigInteger('idRol');
            $table->tinyInteger('activo');
            $table->timestamps();
            $table->foreign('idCaja')->references('id')->on('cajas');
            $table->foreign('idRol')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
