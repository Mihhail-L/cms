<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'description' => $faker->paragraph(3),
        'content' => $faker->paragraph(40),
        'image' => 'posts/XwjZ5onhwHYvRXB8izuyO2qLovMbac0rGaIhztpZ.jpeg',
        'user_id' => rand(1, 4),
        'category_id' => rand(1, 6),
    ];
});
