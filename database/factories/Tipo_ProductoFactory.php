<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\tipo_producto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tipo_producto>
 */
class Tipo_ProductoFactory extends Factory
{
    protected $model = tipo_producto::class;

    public function definition(): array
    {
        $prefixes = ['snack', 'granos'];
        return [
            'nombre'       => $this->faker->randomElement($prefixes),
            'descripcion'  => $this->faker->text($maxNbChars = 200),
        ];
    }
}
