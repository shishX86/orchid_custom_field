<?php

namespace Database\Factories;

use App\Models\Posttype;
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
            'name' => $this->faker->realText(50),
            'slug' => $this->faker->slug(2),
            'description' => $this->faker->realText(),
            'posttype_id' => Posttype::inRandomOrder()->first()->id,
            'content' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
