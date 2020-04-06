<?php

/** @var Factory $factory */

use App\Comment;
use App\Post;
use App\Report;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Report::class, function (Faker $faker) {
    return [
        //
    ];
});

$factory->state(Report::class, 'post', function (Faker $faker) {
    return [
        'reportable_id' => Post::all()->random()->id,
        'reportable_type' => Post::class,
        'user_id' => User::all()->random(),
        'reason' => $faker->randomElement(Report::$reasons),
        'body' => $faker->realText(100),
    ];
});

$factory->state(Report::class, 'user', function (Faker $faker) {
    $reporter = User::all()->random()->id;
    $reported = User::all()->random()->id;
    while ($reporter == $reported) {
        $reported = User::all()->random()->id;
    }
    return [
        'reportable_id' => $reported,
        'reportable_type' => User::class,
        'user_id' => $reporter,
        'reason' => $faker->randomElement(Report::$reasons),
        'body' => $faker->realText(100),
    ];
});

$factory->state(Report::class, 'comment', function (Faker $faker) {
    return [
        'reportable_id' => Comment::all()->random()->id,
        'reportable_type' => Comment::class,
        'user_id' => Comment::all()->random(),
        'reason' => $faker->randomElement(Report::$reasons),
        'body' => $faker->realText(100),
    ];
});
