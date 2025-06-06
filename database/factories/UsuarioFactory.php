<?php

namespace Database\Factories;

use App\Models\rol;
use App\Models\usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\usuario>
 */
class UsuarioFactory extends Factory
{
    
    protected $model = usuario::class;

    public function definition(): array
    {
        return [
            'nombre'             => $this->faker->firstName(),
            'apellido_paterno'   => $this->faker->lastName(),
            'apellido_materno'   => $this->faker->lastName(),
            'telefono'           => $this->faker->e164PhoneNumber(),
            'password'           => $this->faker->password(),
            'correo_electronico' => $this->faker->email(),
            'id_rol'             => \App\Models\rol::factory(),
        ];
    }
}
