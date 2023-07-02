<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'keywords' => 'Keyword 1, Keyword 2, Keyword 3',
            'meta_desc' => 'Lorem Ipsum Sit Dolor Sit Amet Amartha Amertatum Sit Color Amut Amet Ammat',
            'user_id' => 1,
        ]);
    }
}
