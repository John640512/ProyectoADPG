<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ubicacion_proveedor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ubicacion_proveedor>
 */
class Ubicacion_ProveedorFactory extends Factory
{
    protected $model = ubicacion_proveedor::class;

    public function definition(): array
    {
        return [
            'estado'          => $this->faker->state(),
            'calle'           => $this->faker->optional()->streetName(),
            'colonia'         => $this->faker->optional()->word(),
            'cp'              => $this->faker->postcode(),
            'numero_externo'  => $this->faker->numberBetween(100, 999),
            'numero_interno'  => $this->faker->numberBetween(1, 100),
        ];
    }
}
