<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $posts = Post::all();
        $fieldsCount = range(1, Field::count());

        $posts->each(function($post) use ($faker, $fieldsCount) {
            $randomNumber = $faker->numberBetween(1, 3);
            $post->fields()->attach($faker->randomElements($fieldsCount, $randomNumber));
        });
    }
}
