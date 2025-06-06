<?php

namespace Database\Factories;

use App\Models\permiso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\permiso>
 */
class PermisoFactory extends Factory
{
    protected $model = permiso::class;

    public function definition(): array
    {
        return [
            'nombre'      =>$this->faker->name(),
            'descripcion' =>$this->faker->text($maxNbChars = 200),
        ];
    }
}
