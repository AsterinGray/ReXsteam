<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionHeaderFactory extends Factory
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
            'card_name' => $this->faker->firstName(),
            'card_number' => $this->faker->numberBetween(100000000000, 999999999999),
            'card_country' => $this->faker->country(),
            'expired_month' => $this->faker->month(),
            'expired_year' => $this->faker->year(),
            'cvc' => $this->faker->numberBetween(100, 9999),
            'postal_code' => $this->faker->postcode(),
            'checkout_status' => $this->faker->randomElement(["cart", "pending", "completed"]),
            'total_price' => $this->faker->numberBetween(1, 100000)
        ];
    }
}
