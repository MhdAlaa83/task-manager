<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        $statuses = ['todo','doing','done'];
        $start = now()->subDays(30);
        $end   = now()->addDays(30);

        return [
            'name'        => fake()->sentence(3),
            'description' => fake()->boolean(70) ? fake()->paragraph() : null,
            'status'      => $statuses[array_rand($statuses)],
            'due_date'    => fake()->boolean(80) ? fake()->dateTimeBetween($start, $end)->format('Y-m-d') : null,
        ];
    }
}
