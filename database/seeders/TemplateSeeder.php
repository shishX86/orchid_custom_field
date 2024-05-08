<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Template::count() > 0) return;

        $this->command->info("Старт наполнения запрещённых ссылок");

        $jsonContent = json_encode(
            [
                
            ]
        );

        DB::table('templates')->insert([
            [
                'name' => $faker->name(),
                'slug' => $faker->slug(2),
                'content' => json_encode()
            ]
        ])
    }
}
