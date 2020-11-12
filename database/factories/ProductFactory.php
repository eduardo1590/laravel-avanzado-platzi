<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(10000,60000),
        'category_id' => factory(App\Category::class)->create([
            'name' => 'Otros', 
        ]),
        'created_by' => factory(App\User::class)->create([
            'name' => 'Administrador', 
        ]),
       /* 'created_by' => function(){
            return App\User::query()->inRandomOrder()->first()->id;
        }*/
    ];
});
