<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use App\User;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'description' => $faker->paragraph(1),
        'content' => $faker->paragraph(40),
        'image' => 'posts/XwjZ5onhwHYvRXB8izuyO2qLovMbac0rGaIhztpZ.jpeg',
        'user_id' => function() {
            return User::all()->random();
        },
        'category_id' => function() {
            return Category::all()->random();
        },
    ];
});
