<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Article::factory(30)->create();
         \App\Models\Comment::factory(60)->create();
//        $this->call(ArticleSeeder::class);
    }
}
