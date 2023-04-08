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
        Schema::create('pertenece_a', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idLibro');
            $table->unsignedBigInteger('idGenero');
            $table->timestamps();

            $table->foreign('idLibro')->references('id')->on('libro');
            $table->foreign('idGenero')->references('id')->on('genero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertenece_a');
    }
};
