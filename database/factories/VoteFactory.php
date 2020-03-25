<?php

/** @var Factory $factory */

use App\Comment;
use App\Post;
use App\User;
use App\Vote;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Vote::class, function (Faker $faker) {
    return [
        //
    ];
});
$factory->state(Vote::class, 'comment', function (Faker $faker) {
    $comment = Comment::all()->random();
    $type = ($faker->randomDigit > 5) ? 'UP' : 'DOWN';
    if ($type == 'UP') {
        $comment->increment('likes', 1);
    } else {
        $comment->increment('dislikes', 1);
    }
    return [
        'user_id' => User::all()->random()->id,
        'voteable_id' => $comment->id,
        'voteable_type' => Comment::class,
        'type' => $type,
    ];
});

$factory->state(Vote::class, 'post', function (Faker $faker) {
    $post = Post::all()->random();
    $type = ($faker->randomDigit > 5) ? 'UP' : 'DOWN';
    if ($type == 'UP') {
        $post->increment('likes', 1);
    } else {
        $post->increment('dislikes', 1);
    }
    return [
        'user_id' => User::all()->random()->id,
        'voteable_id' => $post->id,
        'voteable_type' => Post::class,
        'type' => $type,
    ];
});
