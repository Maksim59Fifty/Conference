<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConferenceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'lecturers'   => $this->faker->name() . ', ' . $this->faker->name(),
            'date'        => $this->faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
            'time'        => $this->faker->time('H:i'),
            'address'     => $this->faker->address(),
        ];
    }
}
