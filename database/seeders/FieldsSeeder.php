<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fields')->insert([
            [
                'name' => 'Хэдер',
                'slug' => 'header',
                'visibility' => 'global',
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Футер',
                'slug' => 'footer',
                'visibility' => 'global',
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Слайдер',
                'slug' => 'slider',
                'visibility' => 'local',
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'FAQ',
                'slug' => 'faq',
                'visibility' => 'local',
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Баннер',
                'slug' => 'home',
                'visibility' => 'local',
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
