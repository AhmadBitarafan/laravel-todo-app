<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(1),
            'description' => $this->faker->paragraph(5),
            'completed' => $this->faker->boolean(70),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
