<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Template;
use App\Models\User;
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
        $this->call(PosttypeSeeder::class);

        if(Template::count() === 0) {
            $this->command->info("Наполнения полей");
            $this->call(TemplateSeeder::class);
            $this->command->info("Готово!");
        }

        if(Post::count() === 0) {
            $this->command->info("Наполнения постов");
            $this->call(PostSeeder::class);
            $this->command->info("Готово!");
        }

        if(DB::table('post_template')->count() === 0) {
            $this->command->info("Наполнения связей постов с полями");
            $this->call(TemplatePostSeeder::class);
            $this->command->info("Готово!");
        }

        if(User::where('email', 'admin@admin.com')->count() === 0) {
            $this->command->info("Создание админа");
            Artisan::call('orchid:admin admin admin@admin.com password');
        }
    }
}
