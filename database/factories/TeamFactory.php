<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Team::class, function (Faker $faker) {
    $name = $faker->name;
    
    return [
        'name'  => $name,
        'slug'  => Str::slug($name)
    ];
});
