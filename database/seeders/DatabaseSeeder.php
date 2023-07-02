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
        // \App\Models\User::factory(10)->create();
        $this->call(RegisterUserSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(PostsSeeder::class);
    }
}
