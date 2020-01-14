<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {

  $company_name = $faker-> company;
  $company_web_site = str_replace(",","",$company_name);

    return [
        'name' =>  $company_name,
        'email' => $faker-> companyEmail,
        'logo' => $faker-> imageUrl,
        'website' =>  'www.' . str_replace(" ","-",$company_web_site) .'.com'

    ];
});
