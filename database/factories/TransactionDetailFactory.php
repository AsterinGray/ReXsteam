<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'transaction_id' => $this->faker->numberBetween(1, 10),
            'game_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
