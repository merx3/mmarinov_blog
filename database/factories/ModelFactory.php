<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(mt_rand(5, 8)),
        'description' => $faker->sentence(mt_rand(9, 15)),
        'slug' => str_replace(' ', '-', strtolower($faker->sentence(mt_rand(3, 5)))),
        'author_id' => 1,
        'content' => $faker->paragraph(mt_rand(3, 5)),
        'published_at' => $faker->dateTimeBetween('-1 month', '+3 days')
    ];
});
