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
    $url = $faker->url;
    $site_name = Post::findSiteName($url);
    try {
        $site = Site::where(['domain' => $site_name])->firstOrFail();
    } catch (Exception $e) {
        $site = Site::create([
            'domain' => $site_name,
        ]);
    }
    $site->increment('post_count');
    return [
        'user_id' => User::all()->random()->id,
        'uri' => $uri,
        'title' => $title,
        'body' => $faker->text(100),
        'link' => $faker->url,
        'site_id' => $site->id,
    ];
});
