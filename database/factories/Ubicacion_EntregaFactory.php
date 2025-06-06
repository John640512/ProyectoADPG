<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ubicacion_entrega;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ubicacion_entrega>
 */
class Ubicacion_EntregaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_negocio'      => $this->faker->company(),
            'estado'              => $this->faker->state(),
            'calle'               => $this->faker->streetName(),
            'colonia'             => $this->faker->citySuffix(),
            'entre_calles'        => $this->faker->streetAddress(),
            'descripcion_lugar'   => $this->faker->text(),
            'cp'                  => $this->faker->postcode(),
            'numero_externo'      => $this->faker->buildingNumber(),
            'numero_interno'      => $this->faker->optional()->buildingNumber(),
        ];
    }
}
