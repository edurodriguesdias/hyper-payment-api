<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\User;
use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    $fakerBR = FakerFactory::create('pt_BR');
        
    $document = $this->faker->boolean(50) ? $fakerBR->cpf : $fakerBR->cnpj;
    $type = $this->faker->boolean(50) ? 'customer' : 'shopkeeper';

    return [
        'name' => $this->faker->name(),
        'document' => preg_replace("/[^0-9]/", '', $document),
        'email' => $this->faker->unique()->safeEmail,
        'password' => '#hyperpay@@',
        'type' => $type
    ];
});
