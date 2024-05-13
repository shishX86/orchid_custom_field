<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if(Field::count() === 0) {
            $this->command->info("Наполнения полей");
            Field::factory(10)->create();
            $this->command->info("Готово!");
        }

        if(Post::count() === 0) {
            $this->command->info("Наполнения постов");
            Post::factory(10)->create();
            $this->command->info("Готово!");
        }

        if(DB::table('field_post')->count() === 0) {
            $this->command->info("Наполнения связей постов с полями");
            $this->call(FieldPostSeeder::class);
            $this->command->info("Готово!");
        }

        if(User::where('email', 'admin@admin.com')->count() === 0) {
            $this->command->info("Создание админа");
            Artisan::call('orchid:admin admin admin@admin.com password');
        }
    }
}
