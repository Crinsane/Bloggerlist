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
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Projects\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->word),
    ];
});

$factory->define(App\Projects\Project::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->paragraph(mt_rand(10, 35)),
        'category_id' => $faker->randomElement(range(1, 7)),
        'reward' => $faker->paragraph(mt_rand(2, 4)),
        'location' => $faker->city,
        'created_at' => $faker->dateTimeThisMonth,
    ];
});

$factory->define(App\Projects\Step::class, function (Faker\Generator $faker) {
    return [
        'order' => $faker->numberBetween(1, 999),
        'title' => $faker->sentence(3),
        'description' => $faker->paragraph(mt_rand(2, 10)),
    ];
});