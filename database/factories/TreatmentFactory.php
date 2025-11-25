<?php

namespace Database\Factories;

use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    protected $model = Treatment::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'duracion' => $this->faker->numberBetween(15, 120),
            'costo' => $this->faker->randomFloat(2, 20, 500),
            'cuidados' => $this->faker->paragraph(),
            'doctor_id' => null,
        ];
    }
}
