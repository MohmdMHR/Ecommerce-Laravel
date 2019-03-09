<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [

        'name'=> $faker->sentence(3),
        'image'=> 'uploads/product/img.png',
        'description'=>$faker->paragraph(4),
        'price'=>$faker->numberBetween(100, 1000)

    ];
});
