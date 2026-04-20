<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'age' => fake()->numberBetween(1, 90),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'doctor_id' => \App\Models\Doctor::inRandomOrder()->first()->id ?? null,
        ];
    }
}
