<?php

use App\Post;
use App\Tag;
use App\User;
use App\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        factory(Post::class, 45)->create();
        $posts = Post::all();
        $posts_count = count($posts);
        $tags = Tag::all();
        $tags_count = count($tags);
            if($tags_count > 0) {
                foreach($posts as $post) {
                    for($j = rand(1, $tags_count); $j < $tags_count; $j++) {
                        $tag = $tags->random();
                        $post->tags()->syncWithoutDetaching($tag);
                    }
                }
            }
        
    }
}
