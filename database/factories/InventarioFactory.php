<?php

namespace Database\Factories;

use App\Models\inventario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\inventario>
 */
class InventarioFactory extends Factory
{
    protected $model = inventario::class;

    public function definition(): array
    {
        return [
            'cantidad_total_tonelada'   => $this->faker->randomFloat(2, 0, 99999.99),
            'nivel_actual_stock'        => $this->faker->randomFloat(2, 0, 99999.99),
            'nivel_minimo_stock'        => $this->faker->randomFloat(2, 0, 99999.99),
            'fecha_corte_semanalmente'  => $this->faker->dateTime(),
            'estado'                    => $this->faker->randomElement(['P', 'T']),
        ];
    }
}
