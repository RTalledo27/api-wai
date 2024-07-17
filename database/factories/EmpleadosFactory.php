<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Empleados;
use App\Models\Roles;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleados>
 */
class EmpleadosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Empleados::class;

    public function definition(): array
    {
        return [
            //
            'idRol' => Roles::factory(),
            'nombre_empleado' => $this->faker->name,
            'dni_empleado' => $this->faker->numerify('########'),
            'correo_empleado' => $this->faker->unique()->safeEmail,
            'contraseña' => bcrypt('password'), // Usar contrasena sin ñ
            'usuario' => $this->faker->userName,
        ];
    }
}
