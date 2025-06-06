<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\producto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'            => $this->faker->words($nb = 2, $asText = true),
            'descripcion'       => $this->faker->text($maxNbChars = 300),
            'fecha_registro'    => $this->faker->dateTime($max = 'now', $timezone = null),
            'id_inventario'     => \App\Models\inventario::factory(),
            'id_tipo_producto'  => \App\Models\tipo_producto::factory(),
            'id_proveedor'      => \App\Models\proveedor::factory(),
            'id_ubicacion'      => \App\Models\ubicacion::factory(), 
        ];
    }
}
