<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosttypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->create('page', 'Страница');
        $this->create('event', 'Событие');
        $this->create('news', 'Новости');
        $this->create('article', 'Статьи');
    }

    private function create(string $slug, string $title): void {
        $table = DB::table('posttypes');

        if(!$table->where('slug', $slug)->exists()) {
            $table->insert([
                'name' => $title,
                'slug' => $slug,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
