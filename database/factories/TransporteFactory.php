<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\transporte;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\transporte>
 */
class TransporteFactory extends Factory
{
    protected $model = transporte::class;

    public function definition(): array
    {
        return [
            'fecha_salida'        => $this->faker->dateTime(),
            'tipo'                => $this->faker->randomElement(['Camion', 'Barco', 'Avion', 'Tren']),
            'color'               => $this->faker->colorName(),
            'cantidad_toneladas'  => $this->faker->randomFloat(2, 1, 99999.99),
            'modelo'              => $this->faker->bothify('Modelo ##??'),
            'id_trabajador'       => \App\Models\trabajador::inRandomOrder()->first()->id_trabajador,
            'id_producto'         => \App\Models\producto::inRandomOrder()->first()->id_producto,
        ];
    }
}
