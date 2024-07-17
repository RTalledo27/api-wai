<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proyectos;
use App\Models\Clientes;
use App\Models\Empleados;
use App\Models\Estados;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyectos>
 */
class ProyectosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Proyectos::class;

    public function definition(): array
    {
        return [
            //
            'idCliente' => Clientes::factory(),
            'idEmpleado' => Empleados::factory(),
            'idEstado' => Estados::factory(),
            'nombre_proyecto' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
            'fecha_inicio' => $this->faker->date,
            'fecha_fin' => $this->faker->date,
        ];
    }
}
