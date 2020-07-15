<?php

use App\Post;
use App\Category;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        $categories = Category::all();

        foreach ($categories as $key => $category) {

            for ($i = 1; $i <= 20; $i++) {

                Post::create([
                    'title' => "Post $i $key",
                    'url_clean' => "post-$i-$key",
                    'content' => 'A CKEditor 5 build compiles a specific editor class and a set of plugins. Using builds is the simplest way to include the editor in your application, but you can also use the editor classes and plugins directly for greater flexibility.',
                    'posted' => 'yes',
                    'category_id' => $category->id
                ]);
            }
        }
    }
}
