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
        Schema::create('libro_autor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idAutor');
            $table->unsignedBigInteger('idLibro');
            
            $table->foreign('idLibro')->references('id')->on('libro');
            $table->foreign('idAutor')->references('id')->on('autor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_autor');
    }
};
