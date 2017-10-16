<?php

use Faker\Generator as Faker;
Use App\User;
use App\Country;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;
    static $salt;
    static $pass;

    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'gender' => $faker->randomElement(User::getGenders()),
        'nametitle' => $faker->randomElement(User::getNametitles()),
        'state' => $faker->state,
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'street' => $faker->streetName,
        'dob' => $faker->dateTimeBetween('-90 years', '-18 years')->format('Y-m-d'),
        'phone' => $faker->phoneNumber,
        'cell' => $faker->phoneNumber,
        'picture' => $faker->imageUrl($width = 70, $height = 70, $category = 'people', $randomize = false, $word = mt_rand(1, 10)),
        'nat' => $faker->randomElement(Country::getAllCodeValues()),
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'remember_token' => $salt ?: $salt = str_random(10),
        'pass' => $pass ?: $pass = str_random(6),
        'passwordmd5' => md5($salt . $pass),
        'passwordsha1' => sha1($salt . $pass),
        'passwordsha256' => hash('sha256', $salt . $pass),
        'password' => $password ?: $password = bcrypt(hash('sha256', $salt . $pass)),
    ];
});
