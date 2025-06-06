<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\costo_por_tonelada;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\costo_por_tonelada>
 */
class Costo_por_ToneladaFactory extends Factory
{
    protected $model = costo_por_tonelada::class;

    public function definition(): array
    {
        return [
            'costo_tonelada'   => $this->faker->randomFloat(2, 0.01, 99999999.99),
            'id_proveedor'     => \App\Models\proveedor::factory(),
            'id_tipo_producto' => \App\Models\tipo_producto::factory(),
        ];
    }

}
