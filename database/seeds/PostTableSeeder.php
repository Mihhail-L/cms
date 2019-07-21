<?php

use App\Post;
use App\Tag;
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
        $tags = Tag::all();
        $last = count($tags) - 1;
        for($i = 0; $i < 12; $i++) {
            $post = Post::create([
                'title' => $faker->sentence(6),
                'description' => $faker->sentence(12),
                'content' => $faker->paragraph(40),
                'image' => 'posts/XwjZ5onhwHYvRXB8izuyO2qLovMbac0rGaIhztpZ.jpeg',
                'user_id' => rand(1, 4),
                'category_id' => rand(1, 6),
                'published_at' => $faker->dateTimeBetween($startDate = '-1 month', $endDate = 'now'),
            ]);
            if(count($tags) > 0) {
                for($j = rand(1, 6); $j < 6; $j++) {
                    $tag = rand(1, 6);
                    $post->tags()->syncWithoutDetaching($tag);
                }
            }
        }
        
    }
}
