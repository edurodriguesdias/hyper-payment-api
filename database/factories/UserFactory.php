<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
class UserFactory extends Factory
{
    protected $model = User::class;
    
    public function definition()
    {
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
    }
}
