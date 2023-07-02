<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Post::create([
            "cover"     => "https://i0.wp.com/smpn1kedungpring.sch.id/wp-content/uploads/2021/02/placeholder-2.png?ssl=1",
            "title"     => "Twitter limits number of tweets people can read in a day, Elon Musk announces",
            "slug"      => "news",  
            "user_id"  => 1,
            "category_id"  => 1,
            "desc"      => "Twitter has begun limiting the number of tweets people can read, Elon Musk has announced.
                            Mr Musk, who took over Twitter in October after buying it for 44 billion dollars (£35.5 billion), declared on Saturday that verified accounts are being limited to reading 6,000 posts a day.
                            Unverified accounts can only read 600 posts a day, with new unverified accounts limited to just 300 per day, he said – though he later added: “Rate limits increasing soon to 8,000 for verified, 800 for unverified & 400 for new unverified.”",
            "keywords"  => "Keyword 3, Keyword 4, Keyword 5",
            "meta_desc" => "The move has been condemned by some industry experts.",
        ]);
    }
}
