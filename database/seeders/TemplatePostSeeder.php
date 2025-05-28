<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplatePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $posts = Post::all();
        $templateCount = range(1, Template::count());

        $posts->each(function($post) use ($faker, $templateCount) {
            $randomNumber = $faker->numberBetween(1, 3);
            $post->templates()->attach($faker->randomElements($templateCount, $randomNumber));
        });
    }
}
