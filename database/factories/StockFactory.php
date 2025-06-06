<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\stock;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\stock>
 */
class StockFactory extends Factory
{
    protected $model = stock::class;

    public function definition(): array
    {
        return [
            'fecha_llegada'       => $this->faker->dateTime(),
            'cantidad_toneladas'  => $this->faker->randomFloat(2, 1, 99999.99),
            'metodo_pago'         => $this->faker->randomElement(['F', 'T', 'C']),
            'id_producto'         => \App\Models\producto::factory(),
        ];
    }
}
