<?php

/** @var Factory $factory */

use App\Comment;
use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Comment::class, function (Faker $faker) {
    $post = Post::all()->random();
    $post->increment('comments_count', 1);
    return [
        'user_id' => User::all()->random()->id,
        'commentable_id' => $post->id,
        'commentable_type' => 'App\Post',
        'body' => $faker->realText(100),
    ];
});
