<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Elementos;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Elementos>
 */
class ElementosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */    
    protected $model = Elementos::class;

     
    public function definition(): array
    {
        return [
            //
            'nombre_elemento' => $this->faker->word,
            'descripcion' => $this->faker->sentence,
            'costo' => $this->faker->randomFloat(2, 100, 1000),
   
        ];
    }
}
