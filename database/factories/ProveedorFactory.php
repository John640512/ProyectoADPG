<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\proveedor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tipo_proveedor>
 */
class ProveedorFactory extends Factory
{
    protected $model = proveedor::class;

    public function definition(): array
    {
        return [
            'nombre'             => $this->faker->company(),
            'telefono'           => $this->faker->e164PhoneNumber(),
            'correo_electronico' => $this->faker->email(),
            'rfc'                => $this->faker->bothify('??######?####'),
            'id_ub_proveedor'    => \App\Models\ubicacion_proveedor::factory(),
        ];
    }
}
