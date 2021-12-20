<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(1, 10),
            'name_subscription' => $this->faker->randomElement(['BASIC', 'IMPROVER', 'PREMIUM']),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonth()
        ];
    }
}
