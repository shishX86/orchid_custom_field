<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Field>
 */
class FieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->realText(50),
            'slug' => $this->faker->slug(2),
            'content' => json_encode([
                'test' => 'test'
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
