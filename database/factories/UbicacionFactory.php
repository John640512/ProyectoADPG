<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ubicacion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ubicacion>
 */
class UbicacionFactory extends Factory
{
    protected $model = ubicacion::class;

    public function definition(): array
    {
        return [
            'nombre'      => $this->faker->word(),
            'descripcion' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
