<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clientes;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clientes>
 */
class ClientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Clientes::class;

    public function definition(): array
    {
        return [
            //
            'nombre_cliente' => $this->faker->name,
            'correo_cliente' => $this->faker->unique()->safeEmail,
            'telefono_cliente' => $this->faker->phoneNumber,
            'dni_cliente' => $this->faker->numerify('########'),
        ];
    }
}
