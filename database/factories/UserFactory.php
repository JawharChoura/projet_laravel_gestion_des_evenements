<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'CJ_name' => $this->faker->name(),
            'CJ_email' => $this->faker->unique()->safeEmail(),
            'CJ_password' => Hash::make('password'),
            'CJ_role' => 'user',
        ];
    }
}
