<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\historial_costo_tonelada;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\historial_costo_tonelada>
 */
class Historial_Costo_ToneladaFactory extends Factory
{
    protected $model = historial_costo_tonelada::class;

    public function definition(): array
    {
        return [
            'fecha_registro'   => $this->faker->dateTime($max = 'now', $timezone = null),
            'costo_anterior'   => $this->faker->randomFloat(2, 0, 99999999.99), 
            'costo_actual'     => $this->faker->randomFloat(2, 0, 99999999.99),
            'razon_cambio'     => $this->faker->text(),
            'id_producto'      => \App\Models\producto::factory(),
        ];
    }
}
