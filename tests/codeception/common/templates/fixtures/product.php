<?php
/* @var \Faker\Generator $faker */
return [
    'title' => $faker->word,
    'slug' => $faker->word,
    'description' => $faker->sentence(7, true),
    'category_id' => $faker->numberBetween(1, 7),
    'price' => $faker->randomNumber(),
];