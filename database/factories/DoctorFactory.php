<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'specialization' => fake()->randomElement(['Cardiologist', 'Neurologist', 'Pediatrician', 'Orthopedic Surgeon', 'General Practitioner']),
            'contact' => fake()->phoneNumber(),
        ];
    }
}
