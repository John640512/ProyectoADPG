<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\rol;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\rol>
 */
class RolFactory extends Factory
{
    protected $model = rol::class;

    public function definition(): array
    {
        return [
            'nombre'       => $this->faker->name(),
            'descripcion'  => $this->faker->text($maxNbChars = 200),
        ];
    }
}
