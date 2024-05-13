<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(),
            'description' => $this->faker->realText(),
            'type' => 'page',
            'content' => json_encode([
                'test' => 'test'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
