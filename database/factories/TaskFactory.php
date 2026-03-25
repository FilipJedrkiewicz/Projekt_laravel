<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'due_date' => fake()->dateTimeBetween('now', '+1 month'),
            'category' => fake()->randomElement(['praca', 'dom', 'nauka', 'inne']),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'is_completed' => false,
            'description' => fake()->paragraphs(3, true),
        ];
    }
}
