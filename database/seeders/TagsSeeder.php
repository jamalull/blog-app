<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Tag::create([
            'name' => 'Programming',
            'slug' => 'programming',
            'keywords' => 'Keyword 3, Keyword 4, Keyword 5',
            'meta_desc' => 'Lorem Ipsum Sit Dolor Sit Amet Amartha Amertatum Sit Color Amut Amet Ammat',
        ]);
    }
}
