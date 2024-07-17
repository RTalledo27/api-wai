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
        Schema::create('elementos_cotizacion', function (Blueprint $table) {
            $table->id('idElemento_cotizacion');
            $table->unsignedBigInteger('idElemento');
            $table->unsignedBigInteger('idCotizacion');
            $table->timestamps();

            $table->foreign('idElemento')->references('idElemento')->on('elementos');
            $table->foreign('idCotizacion')->references('idCotizacion')->on('cotizaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementos_cotizacions');
    }
};
