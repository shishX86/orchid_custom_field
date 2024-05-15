<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //pages
        DB::table('posts')->insert([
            [
                'name' => 'Главная страница',
                'slug' => 'home',
                'description' => 'Описание главной страницы',
                'posttype_id' => 1,
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cтраница контактов',
                'slug' => 'contacts',
                'description' => 'Описание страницы контактов',
                'posttype_id' => 1,
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'О компании',
                'slug' => 'about',
                'description' => 'Описание страницы О компании',
                'posttype_id' => 1,
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        //events
        DB::table('posts')->insert([
            [
                'name' => 'Музей лошади',
                'slug' => 'musey_horse',
                'description' => 'Описание музея лошади',
                'posttype_id' => 2,
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Фильм В дорогу, в дорогу',
                'slug' => 'film_road_road',
                'description' => 'Описание фильма в дорогу, в дорогу',
                'posttype_id' => 2,
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Фильм Волга - русская река',
                'slug' => 'about',
                'description' => 'Описание фильма Волга - русская река',
                'posttype_id' => 2,
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        //news
        DB::table('posts')->insert([
            [
                'name' => '«Сиреневая ночь в Музейном городе ВДНХ»: экскурсии, лекции, фотовыставка, пленэры',
                'slug' => 'night_town',
                'description' => 'Описание «Сиреневая ночь в Музейном городе ВДНХ»: экскурсии, лекции, фотовыставка, пленэры',
                'posttype_id' => 3,
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'В парке «Останкино» работают вендинговые автоматы с кормом для птиц',
                'slug' => 'ostankino',
                'description' => 'Описание паркa «Останкино»',
                'posttype_id' => 3,
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        //articles
        DB::table('posts')->insert([
            [
                'name' => 'Как провести День экологического образования на ВДНХ',
                'slug' => 'eco_day',
                'description' => 'Описание Как провести День экологического образования на ВДНХ',
                'posttype_id' => 4,
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Джигитовка и конкур: ВДНХ приглашает на VIII Открытый московский фестиваль конного искусства и спорта',
                'slug' => 'moscow_fest',
                'description' => 'Описание Джигитовка и конкур: ВДНХ приглашает на VIII Открытый московский фестиваль конного искусства и спорта',
                'posttype_id' => 4,
                'content' => json_encode([
                    'test' => 'test'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}