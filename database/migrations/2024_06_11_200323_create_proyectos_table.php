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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id('idProyecto');
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idEmpleado');
            $table->unsignedBigInteger('idEstado');
            $table->string('nombre_proyecto');
            $table->text('descripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->timestamps();

            $table->foreign('idCliente')->references('idCliente')->on('clientes');
            $table->foreign('idEmpleado')->references('idEmpleado')->on('empleados');
            $table->foreign('idEstado')->references('idEstado')->on('estados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
