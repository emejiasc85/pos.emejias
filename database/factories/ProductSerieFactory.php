<?php

use Faker\Generator as Faker;

$factory->define(EmejiasInventory\Entities\ProductSerie::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
