<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 100)->create()->each(function ($user) {
            $user->account()->create([
                'balance' => 100
            ]);
        });
    }
}
