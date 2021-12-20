<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CardsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'list_id' => $this->faker->numberBetween(1, 30),
            'name' => $this->faker->sentence(4),
            'priority' => $this->faker->randomElement(['EASY', 'NORMAL', 'IMPORTANT']),
            'status' => $this->faker->randomElement(['NEW', 'IN_PROCESS', 'COMPLETED'])
        ];
    }
}
