<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Elementos_cotizacion;
use App\Models\Elementos;
use App\Models\Cotizaciones;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Elementos_cotizacion>
 */
class Elementos_cotizacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Elementos_cotizacion::class;

    public function definition(): array
    {
        return [
            //
            'idElemento' => Elementos::factory(),
            'idCotizacion' => Cotizaciones::factory(),
            ];
    }
}
