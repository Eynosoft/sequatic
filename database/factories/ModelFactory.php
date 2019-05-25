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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Common\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('test123'),
        'status' => 'active',
        'role_id' => 1,
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Common\Models\MasterCountry::class, function (Faker\Generator $faker) {

    return [
        'country_name' => $faker->country,
        'country_code' => $faker->countryCode,
        'iso_code_3' => $faker->countryISOAlpha3
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Common\Models\Inquiry::class, function (Faker\Generator $faker) {

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'phone' => mt_rand(1000000000,9999999999),
        'mobile' => mt_rand(1000000000,9999999999),
        'fax' => mt_rand(100000,999999),
        'website' => $faker->url,
        'company_name' => $faker->company,
        'inquiry_type' => 'General',
        'country_id' => mt_rand(1,51),
        'address' => $faker->address,
        'zipcode' => $faker->postcode,
        'comment' => $faker->text
    ];
});
