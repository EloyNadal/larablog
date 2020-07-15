<?php

use App\Post;
use App\PostImage;
use Illuminate\Database\Seeder;

class PostImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostImage::truncate();

        $posts = Post::all();

        foreach ($posts as $key => $post) {



                PostImage::create([
                    'image' => "1594499051.png",
                    'post_id' => $post->id,
                ]);

        }
    }
}
