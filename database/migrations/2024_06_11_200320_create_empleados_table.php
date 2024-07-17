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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('idEmpleado');
            $table->unsignedBigInteger('idRol');
            $table->string('nombre_empleado');
            $table->string('dni_empleado');
            $table->string('correo_empleado');
            $table->string('contraseña');
            $table->string('usuario');
            $table->timestamps();

            $table->foreign('idRol')->references('idRol')->on('roles');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
        Schema::dropIfExists('empleados');
    }
};
