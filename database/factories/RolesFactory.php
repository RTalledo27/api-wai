<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Roles;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Roles>
 */
class RolesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @var string
     */
    protected $model = Roles::class;

    public function definition(): array
    {
        return [
            //
            
            'nombre_rol'=>$this->faker->randomElement(['admin','desarrollador']),
        ];
    }
}
