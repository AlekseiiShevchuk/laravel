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
use Illuminate\Support\Facades\DB;
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->safeEmail,
    ];
});

$factory->define(App\Book::class, function (Faker\Generator $faker) {

    $users = DB::table('users')->lists('id');
    return [
        'title' => $faker->sentence,
        'author' => $faker->name,
        'year' => $faker->year,
        'genre' => $faker->randomElement(['fiction', 'nonfiction', 'novel', 'fantastic', 'since']),
        'user_id' => $faker->randomElement($users),
    ];
});