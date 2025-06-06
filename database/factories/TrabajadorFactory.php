<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\trabajador;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\trabajador>
 */
class TrabajadorFactory extends Factory
{
    protected $model = trabajador::class;

    public function definition(): array
    {
        return [
            'nombre'              => $this->faker->firstName(),
            'apellido_paterno'    => $this->faker->lastName(),
            'apellido_materno'    => $this->faker->lastName(),
            'telefono'            => $this->faker->e164phoneNumber(),
            'correo_electronico'  => $this->faker->unique()->email(),
            'estado'              => $this->faker->state(),
            'calle'               => $this->faker->streetName(),
            'colonia'             => $this->faker->citySuffix(),
            'entre_calles'        => $this->faker->streetName() . 'y' . $this->faker->streetName(),
            'cp'                  => $this->faker->postcode(),
            'numero_externo'      => $this->faker->buildingNumber(),
            'numero_interno'      => $this->faker->optional()->buildingNumber(),
        ];
    }
}
