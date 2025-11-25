<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patients;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->sentence(3),
            'fecha_hora' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'doctor_id' => null,
            'paciente_id' => Patients::inRandomOrder()->value('id') ?? null,
            'tratamiento_id' => Treatment::inRandomOrder()->value('id') ?? null,
        ];
    }
}
