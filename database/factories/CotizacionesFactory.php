<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Empleados;
use App\Models\Clientes;
use App\Models\Proyectos;
use App\Models\Estados;
use App\Models\Cotizaciones;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cotizaciones>
 */
class CotizacionesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Cotizaciones::class;
    public function definition(): array
    {
        return [
            //
            'idEmpleado' => Empleados::factory(),
            'idCliente' => Clientes::factory(),
            'idProyecto' => Proyectos::factory(),
            'fecha_cotizacion' => $this->faker->date,
            'subtotal' => $this->faker->randomFloat(2, 1000, 5000),
            'descuento' => $this->faker->randomFloat(2, 50, 500),
            'total' => $this->faker->randomFloat(2, 500, 4500),
            'idEstado' => Estados::factory(),
        ];
    }
}
