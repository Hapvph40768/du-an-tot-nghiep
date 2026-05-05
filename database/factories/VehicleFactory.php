<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'license_plate' => strtoupper($this->faker->bothify('##?-#####')),
            'type' => $this->faker->randomElement(['Ghế ngồi', 'Giường nằm', 'Limousine', 'VIP']),
            'total_seats' => $this->faker->numberBetween(16, 45),
            'status' => 'active',
        ];
    }
}