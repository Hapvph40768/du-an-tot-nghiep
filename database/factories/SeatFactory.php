<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SeatFactory extends Factory
{
    public function definition(): array
    {
        return [
            'vehicle_id' => null, // sẽ gán sau
            'seat_number' => $this->faker->bothify('?##'),
        ];
    }
}