<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Http\File;
use Faker\Provider\Image;


$factory->define(\App\Models\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraphs(5, true),
        'image' => 'posts-images/'.$faker->image('public/images/posts-images',640,480, null, false),
    ];
});

$factory->define(\App\Comment::class, function(Faker $faker) {
    return [
        'content' => $faker->sentence
    ];
});
