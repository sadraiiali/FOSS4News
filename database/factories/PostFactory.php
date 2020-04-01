<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use App\Site;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->realText(50);
    $uri = Post::findUri($title);
    return [
        'user_id' => User::find(2)->id,
        'uri' => $uri,
        'title' => $title,
        'body' => $faker->text(100),
        'link' => $faker->url,
        'site_id' => Site::all()->random()->id,
    ];
});
