<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\alerta_stock;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\alerta_stock>
 */
class Alerta_StockFactory extends Factory
{
    protected $model = alerta_stock::class;

    public function definition(): array
    {
        return [
            'nivel_minimo' => $this->faker->randomFloat(2, 0.01, 99999.99),
            'notificacion' => $this->faker->randomElement(['S', 'N']),
            'id_stock'     => \App\Models\stock::factory(),
        ];
    }
}
