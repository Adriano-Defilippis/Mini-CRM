<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Employee;

$factory->define(Employee::class, function (Faker $faker) {
    return [
      'first_name' => $faker-> firstName,
      'last_name' => $faker-> lastName,
      'email' => $faker-> email,
      'phone' => $faker-> tollFreePhoneNumber
    ];
});
