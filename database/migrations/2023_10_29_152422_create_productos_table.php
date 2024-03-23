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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->decimal('precio_compra');
            $table->decimal('precio_venta');
            $table->integer('stock');
            $table->integer('cantidad');
            $table->string('unidad');
            $table->unsignedBigInteger('idCategoria');
            $table->integer('activo');
            $table->timestamps();
            $table->string('imagen');
            $table->foreign('idCategoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
