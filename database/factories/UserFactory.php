<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscription;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'subscribed', function () {
    return [
        'subscription_id' => Subscription::inRandomOrder()->first()->id,
        'subscription_expires' => today()->addMonth()->format("Y-m-d")
    ];
});
$factory->state(User::class, 'expired', function () {
    return [
        'subscription_id' => Subscription::inRandomOrder()->first()->id,
        'subscription_expires' => today()->subMonth()->format("Y-m-d")
    ];
});
