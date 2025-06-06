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
        $titles = ['Компонент FAQ', 'Слайдер Базовый', 'Баннер Базовый', 'Баннер со слайдером'];

        return [
            'name' => $this->faker->randomElement($titles),
            'slug' => $this->faker->slug(2),
            'content' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
