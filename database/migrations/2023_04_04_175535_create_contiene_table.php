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
        Schema::create('contiene', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidadUnidades');
            $table->unsignedBigInteger('idPedido');
            $table->unsignedBigInteger('idLibro');
            $table->timestamps();

            $table->foreign('idPedido')->references('id')->on('pedido');
            $table->foreign('idLibro')->references('id')->on('libro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contiene');
    }
};
