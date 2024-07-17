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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id('idCotizacion');
            $table->unsignedBigInteger('idEmpleado');
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idProyecto');
            $table->date('fecha_cotizacion');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('descuento', 8, 2);
            $table->decimal('total', 8, 2);
            $table->unsignedBigInteger('idEstado');
            $table->timestamps();

            $table->foreign('idEmpleado')->references('idEmpleado')->on('empleados');
            $table->foreign('idCliente')->references('idCliente')->on('clientes');
            $table->foreign('idProyecto')->references('idProyecto')->on('proyectos');
            $table->foreign('idEstado')->references('idEstado')->on('estados');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->dropForeign('cotizaciones_idempleado_foreign');
            $table->dropForeign('cotizaciones_idcliente_foreign');
        });
    }
};
