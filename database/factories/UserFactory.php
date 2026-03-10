<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'role' => fake()->randomElement(['admin', 'staff', 'customer']),

            'name' => fake()->name(),

            'email' => fake()->unique()->safeEmail(),

            'phone' => fake()->unique()->numerify('0#########'),

            'password' => static::$password ??= Hash::make('password'),

            'avatar' => null,

            'status' => fake()->randomElement(['active', 'blocked']),
        ];
    }

}
